<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput(),
    new Symfony\Component\Console\Output\NullOutput()
);

use App\Models\Event;
use Illuminate\Support\Str;

$events = Event::where('main_image', 'like', '%via.placeholder.com%')->get();
echo "Found: " . $events->count() . " events to update\n";
$i = 1;
foreach ($events as $e) {
    $e->main_image = 'https://picsum.photos/seed/event_repl_' . $e->id . '/1200/800';
    $e->save();
    echo "Updated ID {$e->id}\n";
    $i++;
}

return 0;
