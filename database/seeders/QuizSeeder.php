<?php

namespace Database\Seeders;

use App\Models\Quizes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $download = env('SEED_DOWNLOAD_IMAGES', false);

        if (!$download) {
            Quizes::factory()->count(10)->create();
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            $remoteUrl = 'https://picsum.photos/seed/quiz' . $i . '/1200/800';
            $img = $remoteUrl;
            try {
                $contents = @file_get_contents($remoteUrl);
                if ($contents !== false) {
                    $dir = storage_path('app/public/quizes');
                    if (!is_dir($dir)) {
                        mkdir($dir, 0755, true);
                    }
                    $filename = 'quiz_' . $i . '.jpg';
                    $path = $dir . DIRECTORY_SEPARATOR . $filename;
                    file_put_contents($path, $contents);
                    $img = 'storage/quizes/' . $filename;
                }
            } catch (\Throwable $e) {
                $img = $remoteUrl;
            }

            Quizes::factory()->create(['img' => $img]);
        }
    }
}
