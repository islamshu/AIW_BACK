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

        return response()->json(['success' => true]);
    }
    
    public function destroy($id)
    {
        $section = HomeSection::find($id);
        $section->delete();
        return redirect()->back();
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
        if ($section->key === 'text') {
            return response()->json([
                'content' => $section->contentable->content ?? [],
                'button_text' => $section->contentable->button_text ?? [],
                'button_link' => $section->contentable->button_link ?? [],
            ]);
        }

        if ($section->key === 'hero_extra') {
            return response()->json([
                'title' => $section->contentable->title ?? [],
                'subtitle' => $section->contentable->subtitle ?? [],
                'button_text' => $section->contentable->button_text ?? [],
                'button_link' => $section->contentable->button_link ?? [],
            ]);
        }

        return response()->json([]);
    }



    public function saveContent(Request $request, HomeSection $section)
    {
        if ($section->key === 'text') {
            $section->contentable->update([
                'content' => [
                    'ar' => $request->content_ar,
                    'en' => $request->content_en,
                ],
                'button_text' => [
                    'ar' => $request->button_text_ar,
                    'en' => $request->button_text_en,
                ],
                'button_link' => [
                    'ar' => $request->button_link_ar,
                    'en' => $request->button_link_en,
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
                'button_link' => [
                    'ar' => $request->button_link_ar,
                    'en' => $request->button_link_en,
                ],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
