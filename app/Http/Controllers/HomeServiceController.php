<?php

namespace App\Http\Controllers;

use App\Models\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeServiceController extends Controller
{
    /* ======================
        INDEX
    =======================*/
    public function index()
    {
        $services = HomeService::orderBy('order')->get();
        return view('dashboard.home-services.index', compact('services'));
    }

    /* ======================
        CREATE
    =======================*/
    public function create()
    {
        return view('dashboard.home-services.form');
    }

    /* ======================
        STORE
    =======================*/
    public function store(Request $request)
    {
        $data = $this->validateService($request);

        if ($request->hasFile('image')) {
            $data['icon'] = null;
            $data['image'] = $request->file('image')
                ->store('home-services', 'public');
        }

        $data['order'] = HomeService::max('order') + 1;
        $data['is_active'] = $request->boolean('is_active');

        HomeService::create($data);

        return redirect()
            ->route('home-services.index')
            ->with('success', 'تم إضافة الخدمة بنجاح');
    }

    /* ======================
        EDIT
    =======================*/
    public function edit(HomeService $homeService)
    {
        return view('dashboard.home-services.form', compact('homeService'));
    }

    /* ======================
        UPDATE
    =======================*/
    public function update(Request $request, HomeService $homeService)
    {
        $data = $this->validateService($request);

        if ($request->hasFile('image')) {
            if ($homeService->image) {
                Storage::disk('public')->delete($homeService->image);
            }

            $data['icon'] = null;
            $data['image'] = $request->file('image')
                ->store('home-services', 'public');
        }

        if ($request->icon) {
            if ($homeService->image) {
                Storage::disk('public')->delete($homeService->image);
            }
            $data['image'] = null;
        }

        $data['is_active'] = $request->boolean('is_active');

        $homeService->update($data);
        return redirect()
            ->route('home-services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    /* ======================
        DELETE
    =======================*/
    public function destroy(HomeService $homeService)
    {
        if ($homeService->image) {
            Storage::disk('public')->delete($homeService->image);
        }

        $homeService->delete();

        return back()->with('success', 'تم حذف الخدمة');
    }

    /* ======================
        SORT (Drag & Drop)
    =======================*/
    public function sort(Request $request)
    {
        if (!$request->has('order') || !is_array($request->order)) {
            return response()->json([
                'status' => false,
                'message' => 'بيانات غير صحيحة'
            ], 422);
        }
    
        foreach ($request->order as $index => $id) {
            HomeService::where('id', $id)->update([
                'order' => $index + 1
            ]);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'تم تحديث ترتيب الخدمات بنجاح'
        ]);
    }
    
    public function toggleStatus(HomeService $homeService)
    {
        $homeService->update([
            'is_active' => ! $homeService->is_active
        ]);

        return response()->json([
            'status' => true,
            'active' => $homeService->is_active,
            'message' => 'تم تحديث الحالة بنجاح'
        ]);
    }


    /* ======================
        VALIDATION
    =======================*/
    private function validateService(Request $request)
    {
        return $request->validate([
            'title.ar'        => 'required|string|max:255',
            'title.en'        => 'required|string|max:255',

            'description.ar'  => 'nullable|string',
            'description.en'  => 'nullable|string',
            'type'  => 'required|in:icon,image',
            'icon'  => 'nullable|required_if:type,icon|string|max:100',
            'image' => 'nullable|required_if:type,image|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }
}
