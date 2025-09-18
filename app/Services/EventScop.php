<?php

namespace App\Services;

use App\Models\Event;

class EventScop
{

    public function searchQuery(?string $q)
    {
        $events = Event::query();
        if (!$q) {
            return $events;
        }

        return $events->where(function ($query) use ($q) {
            $query->where('title', 'LIKE', "%{$q}%")
                ->orWhere('category', 'LIKE', "%{$q}%")
                ->orWhere('location', 'LIKE', "%{$q}%")
                ->orWhere('organizer', 'LIKE', "%{$q}%");
        });
    }

    public function filterByDate(?string $date)
    {
        $events = Event::query();
        if (!$date) {
            return $events;
        }

        return $events->whereDate('event_date', $date)
            ->orderBy('event_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->orderBy('end_time', 'asc')
            ->where('is_published', true)
            ->paginate(10);
    }
}
