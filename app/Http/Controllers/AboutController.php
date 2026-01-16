<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\AboutStep;
use App\Models\AboutValue;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('dashboard.about.index', [
            'steps'  => AboutStep::orderBy('sort_order')->get(),
            'values' => AboutValue::orderBy('sort_order')->get(),
        ]);
    }

    // CREATE + UPDATE (نفس الصفحة)
    public function storeStep(Request $request)
    {
        AboutStep::updateOrCreate(
            ['id' => $request->id],
            [
                'title' => [
                    'ar' => $request->title_ar,
                    'en' => $request->title_en,
                ],
                'description' => [
                    'ar' => $request->desc_ar,
                    'en' => $request->desc_en,
                ],
                'sort_order' => AboutStep::max('sort_order') + 1,
            ]
        );

        return back()->with('success','تم الحفظ بنجاح');
    }

    public function toggleStep(AboutStep $step)
    {
        $step->update(['is_active'=>!$step->is_active]);
        return response()->json(['message'=>'تم التحديث']);
    }

    public function sortSteps(Request $request)
    {
        foreach ($request->order as $i => $id) {
            AboutStep::whereId($id)->update(['sort_order'=>$i]);
        }
        return response()->json(['status'=>true]);
    }
}

