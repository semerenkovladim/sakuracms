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
                'email' => 'admin@ru.com',
                'name' => 'John',
                'surname' => 'Doe',
                'password' => bcrypt('admin'),
                'is_admin' => true,
                'country_id' => 1,
                'role_id' => 2
            ],
        ]);
    }
}
