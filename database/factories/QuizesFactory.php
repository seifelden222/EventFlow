<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quizes>
 */
class QuizesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'event_id' => \App\Models\Event::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'time_start' => $this->faker->time('H:i'),
            'time_end' => $this->faker->time('H:i'),
            'date' => $this->faker->date(),
            'is_active' => $this->faker->boolean(80),
            // stable placeholder (picsum) seeded per-quiz to reduce duplicates
            'img' => 'https://picsum.photos/seed/quiz' . $this->faker->unique()->numberBetween(1, 100000) . '/1200/800',
        ];
    }
}
