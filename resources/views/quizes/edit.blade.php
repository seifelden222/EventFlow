@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Quiz</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('quizes.update', $quizs->id ?? '') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quizs->title ?? '') }}">
            @error('title')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $quizs->description ?? '') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Quiz</button>
        <a href="{{ route('quizes.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
