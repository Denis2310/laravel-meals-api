<?php

use App\Ingredient;

$factory->define(Ingredient::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\Lorem($faker));
    $title = $faker->unique()->word;

    return [
        'title:en' => $title . '-ENG',
        'title:hr' => $title . '-HR',
        'slug' => 'ingredient',
    ];
});
