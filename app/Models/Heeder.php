<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Heeder extends Model
{

    use HasFactory, HasTranslations;
    public $translatable = ['description'];
    protected $fillable = ['type_site'];

}
