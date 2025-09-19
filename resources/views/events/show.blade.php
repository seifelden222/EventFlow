@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
	<div class="row">
		<div class="col-lg-8">
			<div class="card card-dark shadow rounded-4 p-3">
				<h3 class="text-white">{{ $event->title }}</h3>
				<p class="muted small">{{ \Carbon\Carbon::parse($event->event_date)->format('D, M d') }} • {{ $event->start_time }}</p>

				@if($event->main_image)
				<div class="mb-3">
					<img src="{{ asset('storage/'.$event->main_image) }}" alt="{{ $event->title }}" style="width:100%; max-height:360px; object-fit:cover; border-radius:8px;" />
				</div>
				@endif

				<div class="text-muted mb-3">{{ $event->description }}</div>

				<div class="d-flex gap-2">
					<a href="{{ route('events.edit', $event) }}" class="btn btn-outline-warning">Edit Event</a>
					@if($event->qize)
					<a href="{{ route('quizes.show', $event->qize->id) }}" class="btn-view">Open Quiz</a>
					@else
					<a href="{{ route('quizes.create') }}?event_id={{ $event->id }}" class="btn-view">Create Quiz</a>
					@endif
					<a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Back to Events</a>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="side-card p-3 mb-3">
				<div class="title mb-2">Event Info</div>
				<div class="small text-muted">Location: {{ $event->location }}</div>
				<div class="small text-muted">Organizer: {{ $event->organizer }}</div>
			</div>
		</div>
	</div>
</div>

@endsection
