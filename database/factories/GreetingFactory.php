<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Greeting>
 */
class GreetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid,
            'user_id' => User::factory(),
            'title' => fake()->sentence,
            'body' => fake()->paragraph,
            'heart_count' => fake()->numberBetween(10, 50),
            'picture' => null,
            'recipient' => fake()->safeEmail(),
            'send_date' => fake()->date('Y-m-d', '+30 days'),
            'is_public' => fake()->boolean
        ];
    }
}
