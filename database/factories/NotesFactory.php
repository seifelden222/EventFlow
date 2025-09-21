<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notes>
 */
class NotesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'event_id' => \App\Models\Event::factory(),
            'content' => $this->faker->paragraph(),
            // Use a stable placeholder image URL (picsum) seeded per-factory instance
            'img' => 'https://picsum.photos/seed/note' . $this->faker->unique()->numberBetween(1, 100000) . '/800/600',
        ];
    }
}
