<?php

namespace App\Http\Controllers;

use App\Models\GeneralValue;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('dashboard.news.index', compact('news'));
    }

    public function create()
    {
        return view('dashboard.news.form')->with('news', null);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
       
        $data['published_at'] = $request->filled('published_at')
        ? Carbon::createFromFormat('Y-m-d\TH:i', $request->published_at)
        : now();
        News::create($data);

        

        return redirect()->route('dashboard.news.index')
            ->with('success', 'تم إضافة الخبر بنجاح');
    }

    public function edit(News $news)
    {
        return view('dashboard.news.form', compact('news'));
    }
    public function toggle_dashboard(Request $request)
    {
        GeneralValue::setValue('news_enabled', $request->status);


        return response()->json([
            'success' => true
        ]);
    }
    
    public function update(Request $request, News $news)
    {
        $data = $this->validateData($request);
        // $data['is_active'] = $request->boolean('is_active');
        $data['published_at'] = $request->filled('published_at')
        ? Carbon::createFromFormat('Y-m-d\TH:i', $request->published_at)
        : now();
        $news->update($data);
        
        
        return redirect()->route('dashboard.news.index')
            ->with('success', 'تم تحديث الخبر بنجاح');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return back()->with('success', 'تم حذف الخبر');
    }
    public function toggle(News $news)
    {
        $news->update([
            'is_active' => ! $news->is_active
        ]);

        return response()->json([
            'status' => true,
            'active' => $news->is_active,
            'toastr_success'=>'تم تغير الحالة بنجاح'
        ]);
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'title.ar'   => 'required|string|max:255',
            'title.en'   => 'required|string|max:255',

            'excerpt.ar' => 'nullable|string',
            'excerpt.en' => 'nullable|string',

            'content.ar' => 'required|string',
            'content.en' => 'required|string',

            'image'      => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);
    }
}
