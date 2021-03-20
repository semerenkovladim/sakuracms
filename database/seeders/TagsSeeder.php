<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
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
                'title' => 'ноутбуки',
            ],
            [
                'title' => 'телефоны',
            ],
            [
                'title' => 'новинки',
            ],
        ]);
    }
}
