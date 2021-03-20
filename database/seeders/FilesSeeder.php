<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')->insert([
           [
               'path' => '/image/products/1/1.jpg'
           ],
           [
               'path' => '/image/products/1/2.jpg'
           ],
           [
               'path' => '/image/products/1/3.jpg'
           ]
        ]);
    }
}
