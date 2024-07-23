<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Explore extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $fillable = [
        'name',
    ];
    public $translatable = ['description', 'list','name'];
    protected $casts = [
        'list' => 'json',
        'description'=>'json'
    ];
}
