<?php

use App\Tag;

$factory->define(Tag::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\Lorem($faker));
    $title = $faker->unique()->word;

    return [
        'title:en' => $title . '-ENG',
        'title:hr' => $title . '-HR',
        'slug' => 'tag',
    ];
});
