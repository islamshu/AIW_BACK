<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'content',
        'status',
        'order',
        'published_at'
    ];

    protected $casts = [
        'title' => 'array',
        'excerpt' => 'array',
        'published_at' => 'datetime',
    ];
    public function sections()
    {
        return $this->hasMany(PageSection::class)
            ->orderBy('order');
    }
    
public function show(string $slug)
{
    if (in_array($slug, $this->reserved)) {
        abort(404);
    }

    $page = Page::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    return view('frontend.pages.show', compact('page'));
}
}
