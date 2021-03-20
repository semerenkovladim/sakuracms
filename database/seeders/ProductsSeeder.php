<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'title' => 'Lenovo A50',
                'slug' => 'lenovo-a50',
                'description' => 'Notebook',
                'price' => 22499.50,
                'short_description' => 'fefwfw',
                'meta_tags' => '',
                'meta_description' => '',
                'meta_title' => '',
                'category_id' => 8,
            ],
            [
                'title' => 'Lenovo A51',
                'slug' => 'lenovo-a51',
                'description' => 'Notebook',
                'price' => 22499.50,
                'short_description' => 'fefwfw',
                'meta_tags' => '',
                'meta_description' => '',
                'meta_title' => '',
                'category_id' => 8,
            ],
            [
                'title' => 'Lenovo A52',
                'slug' => 'lenovo-a52',
                'description' => 'Notebook',
                'price' => 22499.50,
                'short_description' => 'fefwfw',
                'meta_tags' => '',
                'meta_description' => '',
                'meta_title' => '',
                'category_id' => 8,
            ],
        ]);
    }
}
