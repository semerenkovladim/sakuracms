<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'status_id' => 1,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 1,
                'status_id' => 2,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 1,
                'status_id' => 3,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 1,
                'status_id' => 4,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 2,
                'status_id' => 1,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 2,
                'status_id' => 2,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 2,
                'status_id' => 3,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'user_id' => 2,
                'status_id' => 4,
                'total' => 2500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
