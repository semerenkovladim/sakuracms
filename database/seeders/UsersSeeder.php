<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           [
               'email' => 'admin@example.com',
               'name' => 'John',
               'surname' => 'Doe',
               'password' => bcrypt('admin'),
               'is_admin' => true,
               'country_id' => 1,
               'role_id' => 3
           ],
            [
                'email' => 'customer@example.com',
                'name' => 'John',
                'surname' => 'Doe',
                'password' => bcrypt('customer'),
                'is_admin' => false,
                'country_id' => 1,
                'role_id' => 4
            ],
        ]);
    }
}
