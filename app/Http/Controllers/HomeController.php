<?php

namespace App\Http\Controllers;

use App\Models\HomeService;
use App\Models\News;
use App\Models\Sector;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  
    public function index()
    {
        $sectors = Sector::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        return view('frontend.sectors', compact('sectors'));
    }

    public function loadMore(Request $request)
    {
        $offset = $request->get('offset', 0);

        $sectors = Sector::where('is_active', true)
            ->orderBy('order')
            ->skip($offset)
            ->take(3)
            ->get();

        return view('frontend.sectors_partials', compact('sectors'))->render();
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function services_index()
    {
        $services = HomeService::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('frontend.services.index', compact('services'));
    }

    public function services_show($id)
    {
        $service = HomeService::find($id);
        abort_if(!$service->is_active, 404);
        return view('frontend.services.show', compact('service'));
    }
    public function news()
{
    $news = News::where('is_active', true)
        ->latest('published_at')
        ->paginate(9);

    return view('frontend.news.index', compact('news'));
}

public function show_new(News $news)
{
    abort_if(! $news->is_active, 404);

    return view('frontend.news.show', compact('news'));
}

}
