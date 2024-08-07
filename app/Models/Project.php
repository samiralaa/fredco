<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'title',
        'description',
        'link',
        'category_id',
        'location',
        'scope'
    ];

    public function category() {
        return $this->belongsTo( Category::class, 'categery_id', 'id' );
    }
}
