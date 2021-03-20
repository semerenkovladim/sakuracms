<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute_value')->insert([
           [
               'attribute_id' => 1,
               'value_id' => 1
           ],
           [
               'attribute_id' => 1,
               'value_id' => 2
           ]
        ]);
    }
}
