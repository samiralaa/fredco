<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class ApplyJobs extends Model implements HasMedia
{
      use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_id'
    ];
    
    
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id','id');
    }
}
