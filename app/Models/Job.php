<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    public $fillable = ['title','description','responsibilities','rquirements','summery','type','location'];
    
   public function applications()
    {
        return $this->hasMany(ApplyJobs::class, 'job_id', 'id');
    }
}
