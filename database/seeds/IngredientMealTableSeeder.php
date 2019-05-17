<?php

use App\Ingredient;
use App\Meal;
use Illuminate\Database\Seeder;

class IngredientMealTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Save at least one ingredient per meal
        $ingredients_count = Ingredient::count();
        $max_ingredients_per_meal = 10;

        foreach (Meal::all() as $meal) {
            $ingredients_per_meal = rand(1, $max_ingredients_per_meal);
            $ingredient_id_array = array();

            for ($i = 1; $i <= $ingredients_count; $i++) {
                $ingredient_id_array[] = $i;
            }

            shuffle($ingredient_id_array);
            $ingredient_number = 1;

            while ($ingredient_number <= $ingredients_per_meal) {
                $ingredient_id = array_pop($ingredient_id_array);
                $meal->ingredients()->attach($ingredient_id);
                $meal->save();
                $ingredient_number++;
            }
        }
    }
}
