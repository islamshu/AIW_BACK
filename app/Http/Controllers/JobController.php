<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['group'])
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('dashboard.jobs.index', compact('jobs'));
    }

    public function create()
    {
        $groups = JobGroup::active()->orderBy('order')->get();
        return view('dashboard.jobs.create', compact('groups'))->with('job', null);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        // checkbox optional (لو مش موجودة بالـ form)
        $data['is_active'] = $request->boolean('is_active', true);

        Job::create($data);

        return redirect()
            ->route('dashboard.jobs.index')
            ->with('success', 'تمت إضافة الوظيفة بنجاح');
    }

    public function edit(Job $job)
    {
        $groups = JobGroup::active()->orderBy('order')->get();
        return view('dashboard.jobs.create', compact('job', 'groups'));
    }

    public function update(Request $request, Job $job)
    {
        $data = $this->validateData($request);
        $data['is_active'] = $request->boolean('is_active', $job->is_active);

        $job->update($data);

        return redirect()
            ->route('dashboard.jobs.index')
            ->with('success', 'تم تحديث الوظيفة بنجاح');
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('dashboard.jobs.index')
            ->with('success', 'تم حذف الوظيفة بنجاح');
    }

    // Toggle Status (AJAX) - نفس أسلوبك (GET)
    public function toggle(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $status = (int) $request->status;

        $job->update(['is_active' => $status]);

        return response()->json([
            'success' => true,
            'message' => $status ? 'تم تفعيل الوظيفة' : 'تم إيقاف الوظيفة',
            'is_active' => $status
        ]);
    }

    public function index_applications(Job $job)
    {
        $applications = $job->applications()
            ->latest()
            ->paginate(15);

        return view('dashboard.jobs.applications.index', compact('job', 'applications'));
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'job_group_id' => 'required|exists:job_groups,id',

            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',

            'requirements.ar' => 'nullable|string',
            'requirements.en' => 'nullable|string',

            'publish_from' => 'required|date',
            'publish_to'   => 'nullable|date|after_or_equal:publish_from',
        ]);
    }
    public function show_app(Job $job, $id)
    {
        $application = JobApplication::findOrFail($id);
        // التأكد من أن الطلب ينتمي لهذه الوظيفة
        if ($application->job_id !== $job->id) {
            abort(404);
        }

        return view('dashboard.jobs.applications.show', compact('job', 'application'));
    }

    public function destroy_app(Job $job, $id)
    {
        $application = JobApplication::findOrFail($id);

        // التحقق من أن الطلب ينتمي لهذه الوظيفة
        if ($application->job_id !== $job->id) {
            abort(404);
        }

        try {
            // حذف ملف السيرة الذاتية إذا كان موجوداً
            if ($application->cv_path && Storage::exists($application->cv_path)) {
                Storage::delete($application->cv_path);
            }

            // حذف الطلب من قاعدة البيانات
            $application->delete();

            return redirect()
                ->route('dashboard.jobs.applications.index', $job->id)
                ->with('success', 'تم حذف طلب التقديم بنجاح.');
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.jobs.applications.index', $job->id)
                ->with('error', 'حدث خطأ أثناء حذف طلب التقديم: ' . $e->getMessage());
        }
    }
}
