<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence($nbWords = 4, $variableNbWords = true);
        $slug = Str::slug($title, '-');
        // $filepath = public_path('storage/images');
        // if(!File::exists($filepath)){
        //     File::makeDirectory($filepath);
        // }
        return [
            'name'      => $title,
            'slug'      => $slug,
            'status'    => 1,
            'thumbnail' => $this->faker->imageUrl($width = 640, $height = 480),
            'parent_id' => 0
        ];
    }
}
