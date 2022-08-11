<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $sort = 0;
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'title' => $this->faker->title(),
            'url'   => null,
            'desc'  => null,
            'type'  => 'product',
            'target'=> '_blank',
            'sort' => self::$sort++
        ];
    }
}
