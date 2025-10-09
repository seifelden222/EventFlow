@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-dark p-3 rounded-3">
                <h4>{{ $quiz->title }}</h4>
                <p class="text-muted">{{ $quiz->description }}</p>

                <form method="POST" action="{{ route('quizes.submit', $quiz) }}">
                    @csrf
                    <ol>
                        @foreach($quiz->questions as $question)
                        <li class="mb-3">
                            <p class="fw-bold">{{ $question->text }}</p>
                            @php $options = $question->options_json ?? []; @endphp
                            @foreach($options as $idx => $opt)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="q{{ $question->id }}_{{ $idx }}" value="{{ $idx }}">
                                <label class="form-check-label" for="q{{ $question->id }}_{{ $idx }}">{{ $opt }}</label>
                            </div>
                            @endforeach
                        </li>
                        @endforeach
                    </ol>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Submit Answers</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
