<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Country;
use App\Models\File;
use App\Models\Newsletter;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Database\Factories\CountryFactory;
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
        ]);
        Country::factory()->count(10)->create();
        User::factory()->count(10)->create();
        Category::factory()->count(20)->create();
        Product::factory()->hasAttached(File::factory()->count(5)->create(),[], 'images')->count(30)->create();
        Order::factory()->has(Product::factory()->count(2))->count(20)->create();
        Newsletter::factory()->count(12)->create();
        Promotion::factory()->has(Product::factory()->count(2));
    }
}
