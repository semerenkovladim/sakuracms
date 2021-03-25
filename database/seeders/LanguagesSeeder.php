<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
           [
               'title' => 'English',
               'iso' => 'ENG'
           ],
           [
               'title' => 'Русский',
               'iso' => 'RU'
           ]
        ]);
    }
}
