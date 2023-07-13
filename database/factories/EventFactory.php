<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 100),
            'category_id' => rand(1, 100),
            'event' => ucwords(fake()->sentence()),
            'description' => ucwords(fake()->paragraph()),
            'jumlah' => rand(1, 100),
            'is_complete' => rand(0, 1)
        ];
    }
}
