@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-8">
            <div class="card card-dark shadow rounded-4 p-3 ">
                
                <h4 class="text-white ">Create Quiz</h4>

                <form action="{{ route('quizes.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- If event_id is provided via query string, include it as a hidden field --}}
                    @if(request('event_id'))
                    <input type="hidden" name="event_id" value="{{ request('event_id') }}">
                    <div class="mb-3 text-muted">This quiz will be linked to event ID: <strong>{{ request('event_id') }}</strong></div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label text-white">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-white">Image (optional)</label>
                        <input type="file" name="img" class="form-control">
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-view">Create</button>
                        <a href="{{ route('quizes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
