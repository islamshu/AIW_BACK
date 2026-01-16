<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobsFrontController extends Controller
{
    public function index(Request $request)
    {
        // جلب الوظائف الفعالة والمنشورة فقط
        $jobs = Job::query()
            ->where('is_active', 1)
            ->whereDate('publish_from', '<=', now())
            ->where(function ($q) {
                $q->whereNull('publish_to')
                  ->orWhereDate('publish_to', '>=', now());
            })
            ->get();
    
        // إذا لا يوجد أي وظيفة متاحة → 404
        if ($jobs->isEmpty()) {
            return view('website.jobs.empty');
        }
    
        // اختيار الوظيفة المحددة
        $selectedId = (int) $request->get('job_id');
    
        if ($selectedId) {
            $selectedJob = $jobs->firstWhere('id', $selectedId);
    
            // إذا تم تمرير job_id غير صالح → 404
            if (!$selectedJob) {
                abort(404);
            }
        } else {
            // أول وظيفة كاختيار افتراضي
            $selectedJob = $jobs->first();
        }
    
        return view('website.jobs.apply', compact('jobs', 'selectedJob'));
    }
    

    public function showJson(Job $job)
    {
        abort_unless($job->is_active && $job->isPublished(), 404);

        $locale = app()->getLocale();
        return response()->json([
            'id' => $job->id,
            'title' => $job->getTranslation('title', $locale),
            'requirements' => $job->getTranslation('requirements', $locale),
        ]);
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'job_id' => ['required', 'exists:jobs_site,id'],
            'name'   => ['required', 'string', 'max:255'],
            'phone'  => ['required', 'string', 'max:30'],
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
            'cv_path' => $cvPath,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'تم إرسال طلبك بنجاح، سنتواصل معك قريباً'
        ]);
    }
    
}
