<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class JobGroup extends Model
{
    use HasTranslations;

    protected $table = 'job_groups';

    protected $fillable = [
        'title',
        'order',
        'is_active',
    ];

    public $translatable = [
        'title',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_group_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
