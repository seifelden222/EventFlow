@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-dark shadow rounded-4 p-3">
                <h4 class="text-white">{{ $quizs->title }}</h4>
                <p class="muted small">{{ $quizs->date ? \Carbon\Carbon::parse($quizs->date)->format('M d, Y') : $quizs->created_at->format('M d, Y') }}</p>
                @if($quizs->img)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$quizs->img) }}" alt="{{ $quizs->title }}" style="width:100%; max-height:360px; object-fit:cover; border-radius:8px;" />
                </div>
                @endif

                <div class="text-muted mb-3">{{ $quizs->description }}</div>

                <hr />
                <h5 class="text-white mb-3">Questions</h5>
                <div class="text-muted small">This view currently shows quiz metadata and a placeholder for quiz questions. Implement interactive question rendering as required.</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <a href="{{ route('quizes.index') }}" class="btn btn-outline-info">Back to quizzes</a>
            </div>

            @if($quizs->event)
            <div class="side-card p-3 mb-3">
                <div class="title mb-2">Related Event</div>
                <div>
                    <a href="{{ route('events.show', $quizs->event) }}">{{ $quizs->event->title }}</a>
                    <div class="small text-muted">{{ \Illuminate\Support\Str::limit($quizs->event->description, 80) }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
