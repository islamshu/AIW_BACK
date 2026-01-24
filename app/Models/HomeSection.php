<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'key',
        'order',
        'is_active',
        'contentable_id',
        'contentable_type',
        'admin_title',
        'admin_note',
    ];

    public function contentable()
    {
        return $this->morphTo();
    }
}
