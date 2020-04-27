<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Store extends Model
{
    use HasTranslations;

    protected $with = ['seoTags'];

    public $translatable = ['name','about'];

    /**
     * Get the store's seo tags.
     */
    public function seoTags()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }
    
}
