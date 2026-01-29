<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\JobGroup;

class JobsFrontController extends Controller
{
    public function index(Request $request)
    {
        // الصفحة فقط (بدون payload)
        $groups = JobGroup::where('is_active', 1)
            ->orderBy('order')
            ->get();

        // لو ما في مجموعات (أو بدك تتحقق عبر ajax)، خليها عادي
        if ($groups->isEmpty()) {
            return view('website.jobs.empty');
        }

        return view('website.jobs.apply', [
            'groups' => $groups,
        ]);
    }

    private function jobsQuery()
{
    return Job::query()
        ->where('is_active', 1)
        ->whereDate('publish_from', '<=', now())
        ->where(function ($q) {
            $q->whereNull('publish_to')
              ->orWhereDate('publish_to', '>=', now());
        });
}


    public function ajaxGroups()
    {
        $locale = app()->getLocale();

        $groups = JobGroup::where('is_active', 1)
            ->orderBy('order')
            ->get()
            ->filter(function ($group) {
                return $this->jobsQuery()->where('job_group_id', $group->id)->exists();
            })
            ->values()
            ->map(function ($group) use ($locale) {
                return [
                    'id'    => $group->id,
                    'title' => $group->getTranslation('title', $locale),
                ];
            });

        return response()->json([
            'success' => true,
            'groups'  => $groups,
        ]);
    }

    public function ajaxGroupJobs(JobGroup $group)
    {
        abort_if(!$group->is_active, 404);

        $locale = app()->getLocale();

        $jobs = $this->jobsQuery()
            ->where('job_group_id', $group->id)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($job) use ($locale) {
                return [
                    'id'          => $job->id,
                    'title'       => $job->getTranslation('title', $locale),
                    'requirements'=> $job->getTranslation('requirements', $locale),
                    'share_url'   => url('/jobs') . '#job-' . $job->id,
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'group'   => [
                'id'    => $group->id,
                'title' => $group->getTranslation('title', $locale),
            ],
            'jobs'    => $jobs,
        ]);
    }

    public function ajaxJob(Job $job)
    {
        // لازم تكون الوظيفة منشورة وفعالة
        $exists = $this->jobsQuery()->where('id', $job->id)->exists();
        abort_if(!$exists, 404);

        $locale = app()->getLocale();

        return response()->json([
            'success' => true,
            'job' => [
                'id'           => $job->id,
                'group_id'     => $job->job_group_id,
                'title'        => $job->getTranslation('title', $locale),
                'requirements' => $job->getTranslation('requirements', $locale),
                'share_url'    => url('/jobs') . '#job-' . $job->id,
            ],
        ]);
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'job_id' => ['required', 'exists:jobs_site,id'],
            'name'   => ['required', 'string', 'max:255'],
            'phone'  => ['required', 'string', 'max:30'],
            'summary'=>['required', 'string',''],
            'cv'     => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);
    
        $job = Job::findOrFail($validated['job_id']);
    
        if (!($job->is_active && $job->isPublished())) {
            return response()->json([
                'success' => false,
                'message' => 'هذه الوظيفة غير متاحة حالياً'
            ], 422);
        }
    
        $cvPath = $request->file('cv')->store('cv', 'public');
    
        JobApplication::create([
            'job_id'  => $job->id,
            'name'    => $validated['name'],
            'phone'   => $validated['phone'],
            // 'summary'=>$validated['summary'],
            'cv_path' => $cvPath,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'تم إرسال طلبك بنجاح، سنتواصل معك قريباً'
        ]);
    }
    
}
