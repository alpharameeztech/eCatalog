<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;
    
    public $translatable = ['name'];

    protected $guarded = [] ;
    
    protected $with = ['country'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
