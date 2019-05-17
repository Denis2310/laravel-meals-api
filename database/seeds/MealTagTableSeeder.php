<?php

use App\Meal;
use App\Tag;
use Illuminate\Database\Seeder;

class MealTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Save at least one tag per meal
        $tags_count = Tag::count();

        foreach (Meal::all() as $meal) {
            $max_number_of_tags = rand(1, $tags_count);
            $tag_id_array = array();

            for ($i = 1; $i <= $tags_count; $i++) {
                $tag_id_array[] = $i;
            }

            shuffle($tag_id_array);
            $tag_number = 1;

            while ($tag_number <= $max_number_of_tags) {
                $tag_id = array_pop($tag_id_array);
                $meal->tags()->attach($tag_id);
                $meal->save();
                $tag_number++;
            }
        }
    }
}
