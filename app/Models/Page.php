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
    
}
