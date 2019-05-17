<?php

use App\Category;
use App\Meal;

$factory->define(Meal::class, function (Faker\Generator $faker) {
    $faker->addProvider(new Faker\Provider\Lorem($faker));
    $category_id = rand(0, Category::count());

    $title = $faker->words(rand(1, 4), true);
    $description = $faker->text(50);

    return [
        'title:en' => $title . '-ENG',
        'category_id' => $category_id == 0 ? null : $category_id,
        'description:en' => $description . '-ENG',
        'title:hr' => $title . '-HR',
        'description:hr' => $description . '-HR',
    ];
});
