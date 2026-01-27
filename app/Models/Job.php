<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Job extends Model
{
    use HasTranslations;

    protected $table = 'jobs_site';

    protected $fillable = [
        'job_group_id',
        'title',
        'requirements',
        'publish_from',
        'publish_to',
        'is_active',
    ];

    public $translatable = [
        'title',
        'requirements'
    ];

    protected $casts = [
        'publish_from' => 'date',
        'publish_to'   => 'date',
        'is_active'    => 'boolean',
    ];

    public function group()
    {
        return $this->belongsTo(JobGroup::class, 'job_group_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function isPublished()
    {
        return now()->between(
            $this->publish_from,
            $this->publish_to ?? now()->addYears(10)
        );
    }
}
