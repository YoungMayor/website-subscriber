<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'website_ulid' => Website::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'slug' => fake()->slug(3),
            'keywords' => fake()->words(5),
            'status' => fake()->randomElement(['published', 'draft', 'suspended']),
            'content' => fake()->randomHtml(3, 5),
        ];
    }
}
