<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\Api\EventResources;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $events = Event::query()
            ->filterByDate(request()->only(['start_date', 'end_date']))
            ->searchQuery(request()->input('q'))
            ->paginate(10);
            return EventResources::collection($events);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve events',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->id(); 

            // Handle file upload for API (multipart/form-data)
            if ($request->hasFile('main_image')) {
                $image_name=time().'_'.$request->file('main_image')->getClientOriginalName();
                 $validatedData['main_image'] =$image_name ;
                $path = $request->file('main_image')->store('events', 'public');
                $validatedData['main_image'] = $path;
            }

            $event = Event::create($validatedData);
            return new EventResources($event);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create event',
                'error' => $e->getMessage()
            ], 500);
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $event = Event::find($id);
            if ($event) {
                return new EventResources($event);
            } else {
                return response()->json([
                    'message' => 'Event not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                    'message' => 'Event not found'
                ], 404);
            }
            $validatedData = $request->validated();

            if ($request->hasFile('main_image')) {
                if ($event->main_image && Storage::disk('public')->exists($event->main_image)) {
                    Storage::disk('public')->delete($event->main_image);
                }
                $image_name=time().'_'.$request->file('main_image')->getClientOriginalName();
                 $validatedData['main_image'] =$image_name ;
                $path = $request->file('main_image')->store('events', 'public');
                $validatedData['main_image'] = $path;
            }
            $event->update($validatedData);
            return new EventResources($event);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update event',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                    'message' => 'Event not found'
                ], 404);
            }
            $event->delete();
            return response()->json([
                'message' => 'Event deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete event',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
