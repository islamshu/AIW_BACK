<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /* ===============================
       INDEX
    =============================== */
    public function index()
    {
        $jobs = Job::withCount('applications')->latest()->paginate(10);

        return view('dashboard.jobs.index', compact('jobs'));
    }

    /* ===============================
       CREATE
    =============================== */
    public function create()
    {
        return view('dashboard.jobs.create')->with('job',null);
    }

    /* ===============================
       STORE
    =============================== */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Job::create($data);

        return redirect()
            ->route('dashboard.jobs.index')
            ->with('success', 'تمت إضافة الوظيفة بنجاح');
    }

    /* ===============================
       EDIT
    =============================== */
    public function edit(Job $job)
    {
        return view('dashboard.jobs.create', compact('job'));
    }

    /* ===============================
       UPDATE
    =============================== */
    public function update(Request $request, Job $job)
    {
        $data = $this->validateData($request);

        $job->update($data);

        return redirect()
            ->route('dashboard.jobs.index')
            ->with('success', 'تم تحديث الوظيفة بنجاح');
    }

    /* ===============================
       DELETE
    =============================== */
    public function destroy(Job $job)
    {
        $job->delete();
    
        return redirect()
            ->route('dashboard.jobs.index')
            ->with('success', 'تم حذف الوظيفة بنجاح');
    }
    

    /* ===============================
       TOGGLE STATUS (AJAX)
    =============================== */
    public function toggle(Request $request, $id)
{
    $job = Job::findOrFail($id);
    $status = $request->status;
    
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

        return view('dashboard.jobs.applications.index', compact(
            'job',
            'applications'
        ));
    }

    /* ===============================
       VALIDATION
    =============================== */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',

            'requirements.ar' => 'nullable|string',
            'requirements.en' => 'nullable|string',

            'publish_from' => 'required|date',
            'publish_to'   => 'nullable|date|after_or_equal:publish_from',

        ]);
    }
}
