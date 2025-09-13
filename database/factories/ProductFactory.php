<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->unique()->name();
        $slug =  Str::slug($title);
        $subcategories = [8,10];
        $subCatRandKey = array_rand($subcategories);
        $brands = [1,2,3,4];
        $brandRandKey = array_rand($brands);

        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => 50,
            'sub_category_id' =>$subcategories[$subCatRandKey],
            'brand_id' => $brands[$brandRandKey],
            'price' =>rand(10,1000),
            'sku' =>rand(1000,10000),
            'track_qty' => 'Yes',
            'qty' =>10,
            'is_featured' => 'Yes',
            'status' => 1
        ];
    }
}
