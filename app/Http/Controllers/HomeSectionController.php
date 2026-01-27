<?php

namespace App\Http\Controllers;

use App\Models\HeroExtraSection;
use App\Models\HomeSection;
use App\Models\TextSection;
use App\Support\SectionRegistry;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    public function index()
    {
        $sections = HomeSection::orderBy('order')->get();
        $available = collect(SectionRegistry::all())
        ->except(['repeater', 'hero']);
        
        

        return view('dashboard.home-sections.index', compact('sections', 'available'));
    }

    public function store(Request $request)
    {
        if ($request->key === 'text') {

            $text = TextSection::create([
                'content' => ['ar' => '', 'en' => ''],
                'button_text' => ['ar' => '', 'en' => ''],
                'button_link' => ['ar' => '', 'en' => ''],
            ]);

            HomeSection::create([
                'key' => 'text',
                'order' => HomeSection::max('order') + 1,
                'is_active' => true,
                'contentable_id' => $text->id,
                'contentable_type' => TextSection::class,
            ]);

            return back();
        }

        if ($request->key === 'hero_extra') {

            $hero = HeroExtraSection::create([
                'title' => ['ar' => '', 'en' => ''],
                'subtitle' => ['ar' => '', 'en' => ''],
                'button_text' => ['ar' => '', 'en' => ''],
                'button_link' => ['ar' => '', 'en' => ''],
                'background' => '#0a192f',
            ]);

            HomeSection::create([
                'key' => 'hero_extra',
                'order' => HomeSection::max('order') + 1,
                'is_active' => true,
                'contentable_id' => $hero->id,
                'contentable_type' => HeroExtraSection::class,
            ]);

            return back();
        }
    }

    public function toggle(HomeSection $section)
    {
        $section->update([
            'is_active' => ! $section->is_active
        ]);
    
        return response()->json([
            'success' => true,
            'is_active' => $section->is_active
        ]);
    }
    

    
    public function destroy($id)
    {
        $section = HomeSection::findOrFail($id);
    
        // (اختياري) حذف المحتوى المرتبط
        if ($section->contentable) {
            $section->contentable->delete();
        }
    
        $section->delete();
    
        return response()->json(['success' => true]);
    }
    

    public function reorder(Request $request)
    {
        foreach ($request->order as $i => $id) {
            HomeSection::where('id', $id)->update(['order' => $i + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function edit(HomeSection $section)
    {
        $meta = \App\Support\SectionRegistry::get($section->key);

        $data = null;

        if ($section->key === 'text') {
            $data = TextSection::first();
        }

        return view('dashboard.home-sections.edit', compact(
            'section',
            'meta',
            'data'
        ));
    }
    public function update(Request $request, HomeSection $section)
    {
        if ($section->key === 'text') {

            TextSection::updateOrCreate(
                ['id' => 1], // سكشن واحد فقط
                [
                    'content' => [
                        'ar' => $request->content_ar,
                        'en' => $request->content_en,
                    ],
                ]
            );
        }

        return redirect()
            ->route('dashboard.home-sections.index')
            ->with('success', 'تم حفظ النص بنجاح');
    }

    public function getContent(HomeSection $section)
    {
        $base = [
            'admin_title' => $section->admin_title,
            'admin_note'  => $section->admin_note,
            'button_text' => $section->button_text ?? [],
            'button_link' => $section->button_link,
        ];
    
        if ($section->key === 'text') {
            return response()->json(array_merge($base, [
                'content' => $section->contentable->content ?? [],
            ]));
        }
    
        if ($section->key === 'hero_extra') {
            return response()->json(array_merge($base, [
                'title'    => $section->contentable->title ?? [],
                'subtitle' => $section->contentable->subtitle ?? [],
            ]));
        }
    
        return response()->json($base);
    }
    
    



    public function saveContent(Request $request, HomeSection $section)
    {
        $section->update([
            'admin_title' => $request->admin_title,
            'admin_note'  => $request->admin_note,
            'button_text' => [
                'ar' => $request->button_text_ar,
                'en' => $request->button_text_en,
            ],
            'button_link' => $request->button_link,
        ]);
    
        // سكشن نص
        if ($section->key === 'text') {
            $section->contentable->update([
                'content' => [
                    'ar' => $request->content_ar,
                    'en' => $request->content_en,
                ],
            ]);
        }

        if ($section->key === 'hero_extra') {
            $section->contentable->update([
                'title' => [
                    'ar' => $request->title_ar,
                    'en' => $request->title_en,
                ],
                'subtitle' => [
                    'ar' => $request->subtitle_ar,
                    'en' => $request->subtitle_en,
                ],
                'button_text' => [
                    'ar' => $request->button_text_ar,
                    'en' => $request->button_text_en,
                ],
                'button_link' =>$request->button_link
            ]);
        }

        return response()->json(['success' => true]);
    }
}
