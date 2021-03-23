<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            CountriesSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            AttributesSeeder::class,
            TagsSeeder::class,
            ProductsSeeder::class,
            ValuesSeeder::class,
            AttributeValueSeeder::class,
            AttributeProductSeeder::class,
            FilesSeeder::class,
            ImageProductSeeder::class,
            OrderStatusSeeder::class,
            OrdersSeeder::class,
            OrderProductSeeder::class,
        ]);
    }
}
