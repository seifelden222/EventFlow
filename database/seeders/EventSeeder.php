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
        // Create 8 sample events for testing. Use faker-generated images by default.
        $faker = \Faker\Factory::create();
        $download = env('SEED_DOWNLOAD_IMAGES', false);

        // Get an existing user ID or create one if none exist
        $userId = \App\Models\User::first()?->id ?? \App\Models\User::factory()->create()->id;

        for ($i = 1; $i <= 8; $i++) {
            // Use picsum.photos seeded URL for stable but unique placeholder images
            $remoteUrl = 'https://picsum.photos/seed/event' . $i . '/1200/800';

            $mainImage = $remoteUrl;

            if ($download) {
                // Attempt to download the image into storage/app/public/events
                try {
                    $contents = @file_get_contents($remoteUrl);
                    if ($contents !== false) {
                        $dir = storage_path('app/public/events');
                        if (!is_dir($dir)) {
                            mkdir($dir, 0755, true);
                        }
                        $filename = 'event_' . $i . '.jpg';
                        $path = $dir . DIRECTORY_SEPARATOR . $filename;
                        file_put_contents($path, $contents);
                        // Public URL (assuming `php artisan storage:link` has been run)
                        $mainImage = 'storage/events/' . $filename;
                    }
                } catch (\Throwable $e) {
                    // If download fails, fall back to remote URL
                    $mainImage = $remoteUrl;
                }
            }

            Event::create([
                'user_id' => $userId,
                'title' => 'Sample Event ' . $i,
                'description' => 'This is a sample event for testing the Events index page. #' . $i,
                'location' => 'City ' . $i,
                'event_date' => now()->addDays($i)->toDateString(),
                'start_time' => now()->addDays($i)->format('H:i'),
                'end_time' => now()->addDays($i)->addHours(2)->format('H:i'),
                'is_published' => true,
                'main_image' => $mainImage,
                'category' => ['Music','Art','Food','Tech'][($i-1)%4],
                'organizer' => 'Organizer ' . $i,
            ]);
        }
    }
}
