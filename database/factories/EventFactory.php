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
        return [
            Event::factory()->create([
                'title' => 'Neon Nights Concert', 
                'description' => 'An amazing electronic music concert featuring top DJs and artists. Experience the best night of music and lights.',
                'location' => 'Cairo Opera House',
                'category' => 'Music',
                'organizer' => 'EventFlow',
                'event_date' => '2025-10-15',
                'start_time' => '19:00',
                'end_time' => '22:00',
                'is_published' => true,
                'user_id' => 1
            ])
        ];
    }
}
