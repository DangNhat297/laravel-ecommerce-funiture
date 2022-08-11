<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(3);
        $slug = Str::slug($title);
        return [
            'name'      => $title,
            'slug'      => $slug,
            'image'     => $this->faker->imageUrl($width = 640, $height = 480),
            'parent_id' => 0,
            'status'    => 1
        ];
    }
}
