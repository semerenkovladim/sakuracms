<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->insert([
            [
                'title' => 'Цвет',
            ],
            [
                'title' => 'Размер',
            ],
            [
                'title' => 'Вес',
            ],
        ]);
    }
}
