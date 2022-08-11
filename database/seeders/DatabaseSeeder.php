<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // \App\Models\Category::factory(10)->create();

        // \App\Models\Product::factory(20)->create();
        // $category = Category::all();
        // \App\Models\Product::all()->each(function($product) use ($category){
        //     $product->categories()->attach(
        //         $category->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        //     \App\Models\ProductImage::factory(4)->create(['product_id' => $product->id]);
        // });
        // \App\Models\Slider::factory(5)->create();
    }
}
