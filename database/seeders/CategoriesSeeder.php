<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Телефоны и планшеты',
                'category_id' => null,
            ],
            [
                'title' => 'Смартфоны',
                'category_id' => 1,
            ],
            [
                'title' => 'Samsung',
                'category_id' => 2,
            ],
            [
                'title' => 'Xiaomi',
                'category_id' => 2,
            ],
            [
                'title' => 'IPhone',
                'category_id' => 2,
            ],
            [
                'title' => 'Ноутбуки и ПК',
                'category_id' => null,
            ],
            [
                'title' => 'Ноутбуки',
                'category_id' => 6,
            ],
            [
                'title' => 'Samsung',
                'category_id' => 7,
            ],
            [
                'title' => 'Xiaomi',
                'category_id' => 7,
            ],
            [
                'title' => 'Apple',
                'category_id' => 7,
            ],
        ]);
    }
}
