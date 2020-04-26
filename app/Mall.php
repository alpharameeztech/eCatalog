<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Mall extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'opening_hours', 'address'];

    protected $with = ['city'];

    public function city(){
        return $this->belongsTo(City::class);
    }   
}
