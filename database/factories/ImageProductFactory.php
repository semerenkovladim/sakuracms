<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImageProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image_id' => File::all()->random(),
            'product_id' => Product::all()->random()
        ];
    }
}
