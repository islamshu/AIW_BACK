<?php

namespace App\Http\Controllers;

use App\Models\JobGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobGroupController extends Controller
{
    public function index()
    {
        $groups = JobGroup::withCount('jobs')
            ->orderBy('order')
            ->latest('id')
            ->paginate(10);

        return view('dashboard.job_groups.index', compact('groups'));
    }
    public function reorder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*.id' => 'required|exists:job_groups,id',
            'orders.*.order' => 'required|integer',
        ]);
    
        DB::transaction(function () use ($request) {
            foreach ($request->orders as $item) {
                JobGroup::where('id', $item['id'])
                    ->update(['order' => $item['order']]);
            }
        });
    
        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الترتيب بنجاح'
        ]);
    }
    public function create()
    {
        return view('dashboard.job_groups.create')->with('group', null);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        JobGroup::create($data);

        return redirect()
            ->route('dashboard.job-groups.index')
            ->with('success', 'تمت إضافة العنوان الرئيسي بنجاح');
    }

    public function edit(JobGroup $job_group)
    {
        $group = $job_group;
        return view('dashboard.job_groups.create', compact('group'));
    }

    public function update(Request $request, JobGroup $job_group)
    {
        $data = $this->validateData($request);

        $job_group->update($data);

        return redirect()
            ->route('dashboard.job-groups.index')
            ->with('success', 'تم تحديث العنوان الرئيسي بنجاح');
    }

    public function destroy(JobGroup $job_group)
    {
        // إذا بدك تمنع الحذف لو في وظائف:
        // if ($job_group->jobs()->exists()) {
        //     return back()->with('error', 'لا يمكن حذف هذا العنوان لأنه مرتبط بوظائف');
        // }

        $job_group->delete();

        return redirect()
            ->route('dashboard.job-groups.index')
            ->with('success', 'تم حذف العنوان الرئيسي بنجاح');
    }

    // Toggle (AJAX)
    public function toggle(Request $request, $id)
    {
        $group = JobGroup::findOrFail($id);
        $status = (int) $request->status;

        $group->update(['is_active' => $status]);

        return response()->json([
            'success'   => true,
            'message'   => $status ? 'تم تفعيل العنوان' : 'تم إيقاف العنوان',
            'is_active' => $status,
        ]);
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'order'    => 'nullable|integer|min:0',
            'is_active'=> 'nullable|boolean',
        ]);
    }
}
