<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput(),
    new Symfony\Component\Console\Output\NullOutput()
);

// Boot the framework
$kernel->terminate($input, $status);

// Now use Eloquent
use App\Models\Event;
use Illuminate\Support\Str;

$events = Event::orderBy('id','desc')->take(8)->get();
foreach ($events as $e) {
    $img = $e->main_image;
    if (!$img) {
        $src = 'https://picsum.photos/seed/event/default/800/500';
    } elseif (Str::startsWith($img, ['http://','https://'])) {
        $src = $img;
    } elseif (Str::startsWith($img, ['storage/'])) {
        $src = asset($img);
    } else {
        $src = asset('storage/' . ltrim($img, '/'));
    }
    echo "ID: {$e->id}\n";
    echo "DB: " . ($img ?? '<null>') . "\n";
    echo "SRC: {$src}\n";
    echo "----\n";
}

return 0;
