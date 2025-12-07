<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => rand(1, 2),
            'category_id'   => rand(1, 10),
            'title'         => $this->faker->sentence(3),
            'description'   => $this->faker->paragraph(),
            'weight_kg'     => $this->faker->randomFloat(2, 0.5, 20),
            'dimensions'    => $this->faker->numberBetween(10, 100) . 'x' .
                $this->faker->numberBetween(10, 100) . 'x' .
                $this->faker->numberBetween(10, 100) . ' cm',
            'status'        => $this->faker->randomElement(['available', 'gifted']),
            'upvotes_count' => 0,
            'downvotes_count' => 0,
        ];
    }
}
