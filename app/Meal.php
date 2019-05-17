<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    /**
     * Laravel Translatable - columns that should be translated
     * @var array
     */
    public $translatedAttributes = ['title', 'description'];

    /**
     * Meal can belong to one category
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Meal has many tags
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Meal has many ingredients
     */
    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient');
    }
}
