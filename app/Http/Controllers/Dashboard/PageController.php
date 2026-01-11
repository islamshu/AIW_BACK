<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;

// app/Http/Controllers/Dashboard/PageController.php
class PageController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Pages/Index', [
            'pages' => Page::all(),
        ]);
    }

    public function edit(Page $page)
    {
        return Inertia::render('Dashboard/Pages/Edit', [
            'page' => $page,
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        $page->update($data);
        return redirect()
        ->route('dashboard.pages.index')
        ->with('message', 'تم التعديل بنجاح');
    }
}
