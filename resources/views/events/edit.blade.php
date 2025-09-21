@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-dark shadow rounded-4 p-3">
                <h4 class="text-white mb-3">Edit Event</h4>

                @include('partials.alerts')

                <form action="{{ route('events.update', $event) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label text-white">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-white">Date</label>
                            <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $event->event_date) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white">Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $event->start_time) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Main Image</label>
                        <input type="file" name="main_image" class="form-control">
                        @if($event->main_image)
                        <div class="mt-2"><img src="{{ asset('storage/'.$event->main_image) }}" style="max-width:150px; border-radius:6px;"></div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn-view">Save Changes</button>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="side-card p-3 mb-3">
                <div class="title mb-2">Quick Tips</div>
                <div class="small text-muted">Edit details carefully. Updating the date or time may affect attendees.</div>
            </div>
        </div>
    </div>
</div>

@endsection
