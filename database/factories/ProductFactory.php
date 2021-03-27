<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'slug' => $this->faker->url,
            'price' => $this->faker->randomFloat(),
            'description' => $this->faker->text(2000),
            'short_description' => $this->faker->text(200),
            'category_id' => Category::all()->random()
        ];
    }
}
