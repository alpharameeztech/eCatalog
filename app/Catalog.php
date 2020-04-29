<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Catalog extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description', 'start_at', 'end_at'];

    protected $with = ['store', 'seoTags', 'images', 'tags'];

    /**
     * Get all of the catalog's images.
     */
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    /**
    * Get the store's branch seo tags.
    */
    public function seoTags()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    /*
    * A catalog belongs to a store
    */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     *  A catalog has many tags
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
