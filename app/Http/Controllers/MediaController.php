<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::latest()->get();

        return view('dashboard.media.index', [
            'media' => $media,
            'selectMode' => $request->get('select_mode')
        ]);
    }

    public function grid(Request $request)
    {
        $media = Media::latest()->paginate(20);
        $selectMode = $request->has('select_mode');

        if ($request->ajax() || $request->wantsJson()) {
            return view('dashboard.media._media_grid', compact('media', 'selectMode'));
        }

        return view('dashboard.media.index', compact('media', 'selectMode'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|image|max:5120',
        ]);

        $uploadedMedia = [];

        // 🔥 المسار الصحيح داخل public_html
        $pathDir = public_path('uploads/media');

        if (!file_exists($pathDir)) {
            mkdir($pathDir, 0777, true);
        }

        foreach ($request->file('files', []) as $file) {

            if (!$file || !$file->isValid()) {
                continue;
            }

            // اسم فريد للملف
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // 🔥 رفع داخل public_html/uploads/media
            $file->move($pathDir, $filename);

            $media = Media::create([
                'file_name' => $file->getClientOriginalName(),

                // 🔥 نخزن المسار بدون public
                'file_path' => 'uploads/media/' . $filename,

                'mime_type' => $file->getClientMimeType(),
                'size' => file_exists($pathDir . '/' . $filename)
                    ? filesize($pathDir . '/' . $filename)
                    : 0,
            ]);

            $uploadedMedia[] = $media;
        }

        return response()->json([
            'success' => true,
            'media' => $uploadedMedia
        ]);
    }

    public function update(Request $request, Media $media)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'alt' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500',
            'description' => 'nullable|string',
        ]);

        $media->update(
            $request->only(['title', 'alt', 'caption', 'description'])
        );

        return response()->json([
            'success' => true,
            'media' => [
                'id' => $media->id,
                'title' => $media->title,
                'alt' => $media->alt,
                'caption' => $media->caption,
                'description' => $media->description,
                'file_name' => $media->file_name,
                'created_at' => $media->created_at->format('Y/m/d'),
                'url' => asset('public/'.$media->file_path),
                'human_size' => $media->human_size,
            ]
        ]);
    }

    public function destroy(Media $media)
    {
        $filePath = public_path($media->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $media->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
