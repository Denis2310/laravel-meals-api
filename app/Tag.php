<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Dimsav\Translatable\Translatable;

    /**
     * Laravel Translatable - column that should be translated
     * @var array
     */
    public $translatedAttributes = ['title'];

}
