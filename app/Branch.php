<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Branch extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'opening_hours', 'address'];
    
    protected $with = ['city', 'store', 'mall', 'seoTags'];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function mall(){
        return $this->belongsTo(Mall::class);
    }

    /**
     * Get the store's branch seo tags.
     */
    public function seoTags()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
