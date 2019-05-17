<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 5)->create();

        foreach (Tag::all() as $tag) {
            $tag->slug = $tag->slug . '-' . $tag->id;
            $tag->save();
        }
    }
}
