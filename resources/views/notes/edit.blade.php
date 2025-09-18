@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<!-- ====== Header ====== -->
<div class="container py-4">
    <div class="search-wrap">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <h4 class="mb-0 text-white">📝 Edit Note</h4>
                    <a href="{{ route('notes.show', $note->id) }}" class="btn btn-sm btn-outline-light rounded-3">
                        <i class="bi bi-arrow-left"></i> Back to Note
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Form Content ====== -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-dark shadow rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('notes.update', $note) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Content Field -->
                        <div class="mb-4">
                            <label for="content" class="form-label text-light">
                                <i class="bi bi-journal-text"></i> Note Content
                            </label>
                            <textarea class="form-control form-control-dark @error('content') is-invalid @enderror" 
                                    id="content" name="content" rows="8" 
                                    placeholder="Write your note here..." required>{{ old('content', $note->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Image Display -->
                        @if($note->img)
                        <div class="mb-3">
                            <label class="form-label text-light">
                                <i class="bi bi-image"></i> Current Image
                            </label>
                            <div class="current-image-wrap">
                                <img src="{{ asset('storage/'.$note->img) }}" alt="Current Note Image" class="current-image" />
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image">
                                    <label class="form-check-label text-light" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="img" class="form-label text-light">
                                <i class="bi bi-image"></i> {{ $note->img ? 'Replace Image (Optional)' : 'Note Image (Optional)' }}
                            </label>
                            <input type="file" class="form-control form-control-dark @error('img') is-invalid @enderror" 
                                   id="img" name="img" accept="image/*">
                            <div class="form-text text-muted">
                                Supported formats: JPG, PNG, GIF. Max size: 2MB
                            </div>
                            @error('img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Image Preview -->
                        <div id="imagePreview" class="mb-4 d-none">
                            <label class="form-label text-light">New Image Preview:</label>
                            <div class="preview-wrap">
                                <img id="previewImg" class="preview-image" />
                                <button type="button" class="btn btn-sm btn-outline-danger remove-preview" onclick="removePreview()">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('notes.show', $note->id) }}" class="btn btn-outline-secondary rounded-3">
                                <i class="bi bi-x-lg"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-create rounded-3">
                                <i class="bi bi-check-lg"></i> Update Note
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control-dark {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #e1e1e1;
}

.form-control-dark:focus {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: #17a2b8;
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
    color: #e1e1e1;
}

.form-control-dark::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.current-image-wrap {
    max-width: 300px;
}

.current-image {
    width: 100%;
    max-width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.preview-wrap {
    position: relative;
    display: inline-block;
    max-width: 300px;
}

.preview-image {
    width: 100%;
    max-width: 300px;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.remove-preview {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.form-check-input {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
}

.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}
</style>

<script>
document.getElementById('img').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('img').value = '';
    document.getElementById('imagePreview').classList.add('d-none');
    document.getElementById('previewImg').src = '';
}
</script>

@endsection