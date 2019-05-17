<?php

use App\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['locale' => 'en'],
            ['locale' => 'hr'],
        ];

        foreach ($items as $item) {
            Language::create($item);
        }
    }
}
