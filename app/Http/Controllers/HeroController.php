<?php

namespace App\Http\Controllers;

use App\Models\HomeHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        // سجل واحد فقط – إن لم يوجد يتم إنشاؤه
        $hero = HomeHero::firstOrCreate([]);

        return view('dashboard.home-hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $hero = HomeHero::firstOrFail();

        $data = $request->validate([
            'title.ar'        => 'required|string|max:255',
            'title.en'        => 'required|string|max:255',
            'subtitle.ar'     => 'nullable|string',
            'subtitle.en'     => 'nullable|string',
            'button_text.ar'  => 'nullable|string|max:100',
            'button_text.en'  => 'nullable|string|max:100',
            'button_link'     => 'nullable|url',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // رفع الصورة
        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }

            $data['image'] = $request->file('image')
                ->store('home-hero', 'public');
        }

        $hero->update($data);

        return redirect()
            ->back()
            ->with('success', __('تم تحديث قسم الهيرو بنجاح'));
    }
}
