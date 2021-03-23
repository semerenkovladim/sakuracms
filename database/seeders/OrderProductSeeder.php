<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_product')->insert([
            [
                'order_id' => 1,
                'product_id' => 1
            ],
            [
                'order_id' => 2,
                'product_id' => 2
            ],
            [
                'order_id' => 3,
                'product_id' => 2
            ],
            [
                'order_id' => 4,
                'product_id' => 3
            ],
            [
                'order_id' => 5,
                'product_id' => 1
            ],
            [
                'order_id' => 6,
                'product_id' => 2
            ],
            [
                'order_id' => 7,
                'product_id' => 2
            ],
            [
                'order_id' => 8,
                'product_id' => 3
            ],
        ]);
    }
}
