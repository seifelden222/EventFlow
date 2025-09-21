@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
	<div class="row">
		<div class="col-lg-8">
			<div class="card card-dark shadow rounded-4 p-3">
				<h4 class="text-white mb-3">Create New Event</h4>

				@include('partials.alerts')

				<form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
					@csrf

					<div class="mb-3">
						<label class="form-label text-white">Title</label>
						<input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
					</div>

					<div class="row mb-3">
						<div class="col-md-6">
							<label class="form-label text-white">Date</label>
							<input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}">
						</div>
						<div class="col-md-6">
							<label class="form-label text-white">Start Time</label>
							<input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
						</div>
					</div>

					<div class="mb-3">
						<label class="form-label text-white">Location</label>
						<input type="text" name="location" class="form-control" value="{{ old('location') }}">
					</div>

					<div class="mb-3">
						<label class="form-label text-white">Description</label>
						<textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
					</div>

					<div class="mb-3">
						<label class="form-label text-white">Main Image</label>
						<input type="file" name="main_image" class="form-control">
					</div>

					<div class="d-flex gap-2">
						<button class="btn-view">Create Event</button>
						<a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancel</a>
					</div>
				</form>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="side-card p-3 mb-3">
				<div class="title mb-2">Quick Tips</div>
				<div class="small text-muted">Fill title, date/time and location to make your event discoverable. Use an attractive image.</div>
			</div>
		</div>
	</div>
</div>

@endsection
