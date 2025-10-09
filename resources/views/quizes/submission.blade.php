@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-dark p-3 rounded-3">
                <h4>Submission Result</h4>
                <p class="mb-1"><strong>Quiz:</strong> {{ $submission->quiz->title }}</p>
                <p class="mb-1"><strong>Score:</strong> {{ $submission->score }}</p>
                <p class="mb-3"><strong>Answers:</strong></p>
                <ul>
                    @foreach($submission->answers_json as $qid => $ans)
                    @php
                    $q = $submission->quiz->questions->where('id', $qid)->first();
                    $options = $q->options_json ?? [];
                    @endphp
                    <li>
                        <div class="fw-bold">{{ $q->text }}</div>
                        <div>Selected: {{ $options[$ans] ?? 'N/A' }}</div>
                        <div>Correct: {{ $options[$q->correct_index] ?? 'N/A' }}</div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
