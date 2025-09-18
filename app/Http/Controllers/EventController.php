<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    public function index(WeatherService $weatherService)
    {
        try {
            // Handle graceful fallback for missing events table
                $events = Event::orderBy('event_date', 'desc')->paginate(10)->withQueryString();
        
            
            $city = request()->query('city', 'New York');
            $temb = request()->query('temb', '');
            $description = request()->query('description', '');

            $weather = $weatherService->currentByCity($city, 300, 'metric', 'ar', $temb, $description);

            return view('events.index', ['events' => $events, 'city' => $city, 'weather' => $weather]);
            // return view('events.index', compact('events'));

        } catch (\Exception $e) {
            Log::error('Events index error: ' . $e->getMessage());
            abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $eventRequest)
    {
        try {
            $validatedData = $eventRequest->validated();

            if ($eventRequest->hasFile('main_image')) {
                $img_name=time().'_'.$eventRequest->file('main_image')->getClientOriginalName();
                $path = $eventRequest->file('main_image')->store('events', 'public');
                $validatedData['main_image'] = $path;
            }

            // associate with authenticated user if available
            if (auth()->check()) {
                $validatedData['user_id'] = auth()->id();
            }

            Event::create($validatedData);

            return redirect()->route('events.index')->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the event: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        try {
            // the Event is already provided via route model binding
            return view('events.show', compact('event'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching the event: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $eventRequest, Event $event)
    {
        try {
            $validatedData = $eventRequest->validated();

            // handle main_image upload
            if ($eventRequest->hasFile('main_image')) {
                // delete old image if exists
                if ($event->main_image && Storage::disk('public')->exists($event->main_image)) {
                    Storage::disk('public')->delete($event->main_image);
                }

                $path = $eventRequest->file('main_image')->store('events', 'public');
                $validatedData['main_image'] = $path;
            }

                $event->update($validatedData);

            return redirect()->route('events.index')->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the event: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            // delete associated image from storage
            if ($event->main_image && Storage::disk('public')->exists($event->main_image)) {
                Storage::disk('public')->delete($event->main_image);
            }

            $event->delete();

            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the event: ' . $e->getMessage());
        }
    }
}
