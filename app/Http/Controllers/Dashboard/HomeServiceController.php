<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HomeService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeServiceController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/HomeServices/Index', [
            'services' => HomeService::orderBy('order')->get(),
        ]);
    }
    public function reorder(Request $request)
{
    foreach ($request->items as $item) {
        HomeService::where('id', $item['id'])
            ->update(['order' => $item['order']]);
    }

    return back()->with('message', 'تم تحديث الترتيب بنجاح');
}


    public function create()
    {
        return Inertia::render('Dashboard/HomeServices/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'description.ar' => 'required|string',
            'description.en' => 'required|string',
            'icon' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('home/services', 'public');
        } else {
            $imagePath = null;
        }
        HomeService::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'image' => $imagePath,
            'order' => $request->order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('dashboard.services.index')
            ->with('message', 'تم إضافة الخدمة بنجاح');
    }

    public function edit(HomeService $service)
{
    return Inertia::render('Dashboard/HomeServices/Edit', [
        'service'=>$service ,
    ]);
}


public function update(Request $request, HomeService $service)
{
    $data = $request->validate([
        'title.ar' => 'required|string|max:255',
        'title.en' => 'required|string|max:255',
        'description.ar' => 'nullable|string',
        'description.en' => 'nullable|string',
        'icon' => 'nullable|string|max:255',
        'order' => 'required|integer',
        'image' => 'nullable|image|max:4096',
    ]);

    // إذا تم رفع صورة جديدة
    if ($request->hasFile('image')) {
        // (اختياري) احذف القديمة
        // Storage::disk('public')->delete($service->image);

        $path = $request->file('image')->store('services', 'public');
        $data['image'] = $path;
        $data['icon'] = null; // لأننا اخترنا صورة
    } else {
        // لو المستخدم اختار icon، نسمح بها
        // ملاحظة: إذا icon موجودة نعتبرها اختيار المستخدم
        if (!empty($data['icon'])) {
            $data['image'] = $service->image; // أو null لو تريد إزالة الصورة عند اختيار icon
        }
    }

    $service->update($data);

    return redirect()
        ->route('dashboard.services.index')
        ->with('message', 'تم تحديث الخدمة بنجاح');
}


    public function destroy(HomeService $service)
    {
        $service->delete();

        return back()->with('message', 'تم إضافة الخدمة بنجاح');

    }
}
