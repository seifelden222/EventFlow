<?php

namespace Database\Factories;

use App\Models\Event;
use GuzzleHttp\Promise\Create;
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
        // Return a plain set of attributes. Do NOT create models here
        // since factories are used to create models and calling create()
        // here leads to recursive model creation and memory exhaustion.
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'category' => $this->faker->randomElement(['Music','Art','Food','Tech']),
            'organizer' => $this->faker->company(),
            'event_date' => $this->faker->date(),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'is_published' => $this->faker->boolean(80),
            // For user_id and main_image, use factories or known ids when seeding
            'user_id' => \App\Models\User::factory(),
            'main_image' => $this->faker->imageUrl(),
        ];
    }
}
