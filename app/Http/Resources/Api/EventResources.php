<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'event_date' => $this->event_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'is_published' => $this->is_published,
            // return a full public URL when the image is stored on the `public` disk
            // use asset('storage/...') which maps to the storage symlink (public/storage)
            'main_image' => $this->when($this->main_image, fn () => asset('storage/' . $this->main_image)),
            'category' => $this->category,
            'organizer' => $this->organizer,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
