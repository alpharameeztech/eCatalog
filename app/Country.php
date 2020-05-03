<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    
    public $translatable = ['name'];

    protected $guarded = [] ;

    protected $with = ['page'];

    /**
     * Get the country's page description.
     */
    public function page()
    {
        return $this->morphOne('App\Page', 'pageable');
    }
}
