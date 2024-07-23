<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;

    protected $fillable = [ 'title',];
    // ...
    // public function registerMediaCollections(): void {
    //     $this->addMediaCollection('image')->singleFile();
    // }
    public function projects() {
        return $this->hasMany(Project::class);
    }


}
