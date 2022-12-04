<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articles>
 */
class ArticlesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence($nbWords = 6, $variableNbWords = true),
            'content' => $this->faker->text(),
            'image' => $this->faker->imageUrl(200, 200),
            'user_id' => $this->faker->unique('true')->numberBetween(1, User::count()),
            'category_id' => $this->faker->unique('true')->numberBetween(1, Categories::count()),
        ];
    }
}
