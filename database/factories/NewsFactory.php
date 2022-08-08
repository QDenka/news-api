<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author' => User::factory(),
            'category' => Category::inRandomOrder()->first()->id,
            'title' => fake()->paragraph(2),
            'publishedAt' => fake()->dateTime()
        ];
    }
}
