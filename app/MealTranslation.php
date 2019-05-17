<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealTranslation extends Model
{
    /**
     * Mass-assignment field
     * @var array
     */
    protected $fillable = ['title', 'description'];
}
