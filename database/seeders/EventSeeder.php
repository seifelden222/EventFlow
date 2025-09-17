<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 8 sample events for testing without requiring a factory
        for ($i = 1; $i <= 8; $i++) {
            Event::create([
                'user_id' => 1,
                'title' => 'Sample Event ' . $i,
                'description' => 'This is a sample event for testing the Events index page. #' . $i,
                'location' => 'City ' . $i,
                'event_date' => now()->addDays($i)->toDateString(),
                'start_time' => now()->addDays($i)->format('H:i'),
                'end_time' => now()->addDays($i)->addHours(2)->format('H:i'),
                'is_published' => true,
                'main_image' => 'events/sample1.jpg',
                'category' => ['Music','Art','Food','Tech'][($i-1)%4],
                'organizer' => 'Organizer ' . $i,
            ]);
        }
    }
}
