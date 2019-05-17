<?php

use App\Ingredient;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ingredient::class, 40)->create();

        foreach (Ingredient::all() as $ingredient) {
            $ingredient->slug = $ingredient->slug . '-' . $ingredient->id;
            $ingredient->save();
        }
    }
}
