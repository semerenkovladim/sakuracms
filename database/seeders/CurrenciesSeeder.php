<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'title' => 'Dollar',
                'iso' => 'USD',
                'ratio' => 1
            ],
            [
                'title' => 'Рубль',
                'iso' => 'RUB',
                'ration' => 0.75
            ]
        ]);
    }
}
