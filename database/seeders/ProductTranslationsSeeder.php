<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_translations')->insert([
            [
                'title' => 'Lenovo A50',
                'description' => 'Ноутбук 1',
                'short_description' => 'Описание 1',
                'language_id' => 2,
                'product_id' => 1
            ],
            [
                'title' => 'Lenovo A51',
                'description' => 'Ноутбук 2',
                'short_description' => 'Описание 2',
                'language_id' => 2,
                'product_id' => 2
            ],
            [
                'title' => 'Lenovo A52',
                'description' => 'Ноутбук 3',
                'short_description' => 'Описание 3',
                'language_id' => 2,
                'product_id' => 3
            ],
        ]);
    }
}
