<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_product')->insert([
           [
               'image_id' => 1,
               'product_id' => 1
           ],
           [
               'image_id' => 2,
               'product_id' => 1
           ],
           [
               'image_id' => 3,
               'product_id' => 1
           ]
        ]);
    }
}
