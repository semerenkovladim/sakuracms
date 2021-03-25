<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_translations')->insert([
            [
                'title' => 'Phone and tablet',
                'category_id' => 1,
                'language_id' => 1
            ],
            [
                'title' => 'Smartphone',
                'category_id' => 2,
                'language_id' => 1
            ],
            [
                'title' => 'Notebook and PC',
                'category_id' => 6,
                'language_id' => 1
            ],
            [
                'title' => 'Notebook',
                'category_id' => 7,
                'language_id' => 1
            ],
        ]);
    }
}
