<?php

namespace App\Http\Controllers;

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
}
