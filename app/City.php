<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;

class City extends Model
{
    protected $guarded = [] ;
    
    protected $with = ['country'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
