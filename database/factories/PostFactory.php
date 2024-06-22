<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = fake()->image(null, 360, 360, 'animals', true);

        $imageName = basename($imagePath);

        Storage::disk('public')->putFileAs('images', new File( $imagePath),  $imageName);

        return [
            'title' => fake()->word,
            'content' => fake()->sentence,
            'category_id' => Category::factory(),
            'preview_image' => 'images/' . $imageName,
            'main_image' => 'images/' . $imageName
        ];
    }
}
