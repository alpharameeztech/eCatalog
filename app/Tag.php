<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
    
    protected $with = ['seoTags'];

    /**
     * Get the store's branch seo tags.
     */
    public function seoTags()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
}
