<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create();

        foreach (Category::all() as $category) {
            $category->slug = $category->slug . '-' . $category->id;
            $category->save();
        }
    }
}
