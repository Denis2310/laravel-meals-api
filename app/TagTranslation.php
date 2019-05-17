<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    /**
     * Mass-assignment field
     * @var array
     */
    protected $fillable = ['title'];
}
