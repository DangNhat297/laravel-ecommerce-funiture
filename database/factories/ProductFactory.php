<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $name = $this->faker->sentence(5);
        $slug = Str::slug($name);
        return [
            'name'  => $name,
            'short_desc' => $this->faker->text($maxNbChars = 200),
            'slug'  => $slug,
            'content'   => $this->faker->paragraph($nbSentences = 8, $variableNbSentences = true),
            'price' => rand(100000, 10000000),
            'promotion' => null,
            'quantity'  => 10000,
            'published' => 1,
            'view'  => 0
        ];
    }
}
