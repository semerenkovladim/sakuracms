<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPromotionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'promotion_id' => Promotion::all()->random(),
            'product_id' => Product::all()->random(3)
        ];
    }
}
