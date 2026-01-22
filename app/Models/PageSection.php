<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'type',
        'data',
        'order',
        'is_active',
        'layout_id',
        'column_index',
    ];

    protected $casts = [
        'data'         => 'array',
        'is_active'    => 'boolean',
        'order'        => 'integer',
        'column_index' => 'integer',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
