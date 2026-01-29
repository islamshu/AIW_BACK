<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'name',
        'phone',
        'cv_path',
        'summary',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
