@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <h4 class="text-white mb-4"><i class="bi bi-question-circle text-info"></i> Quizzes</h4>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        @forelse($quizes as $quiz)
        <div class="col">
            @include('quizes._quiz-card', ['quiz' => $quiz])
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-secondary">No quizzes found.</div>
        </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center align-items-center">
        {{ $quizes->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
