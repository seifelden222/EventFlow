@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<!-- ====== Header ====== -->
<div class="container py-4">
    <div class="search-wrap">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <h4 class="mb-0 text-white">📝 Note Details</h4>
                    <a href="{{ route('notes.index') }}" class="btn btn-sm btn-outline-light rounded-3">
                        <i class="bi bi-arrow-left"></i> Back to Notes
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-md-end text-center">
                <div class="btn-group">
                    <a class="btn btn-outline-warning rounded-3" href="{{ route('notes.edit', $note->id) }}">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline" 
                          onsubmit="return confirm('Are you sure you want to delete this note?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger rounded-3">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Note Content ====== -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-dark shadow rounded-4 note-detail-card">
                @if($note->img)
                <div class="note-image-header">
                    <img src="{{ \Illuminate\Support\Str::startsWith($note->img, ['http://','https://']) ? $note->img : asset('storage/'.$note->img) }}" alt="Note Image" class="note-full-image" />
                </div>
                @endif
                
                <div class="card-body p-4">
                    <!-- Note Content -->
                    <div class="note-content-full">
                        {!! nl2br(e($note->content)) !!}
                    </div>
                    
                    <!-- Note Metadata -->
                    <div class="note-metadata mt-4 pt-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="meta-item">
                                    <i class="bi bi-calendar-plus text-info"></i>
                                    <span class="meta-label">Created:</span>
                                    <span class="meta-value">{{ $note->created_at->format('M d, Y - h:i A') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="meta-item">
                                    <i class="bi bi-calendar-check text-warning"></i>
                                    <span class="meta-label">Updated:</span>
                                    <span class="meta-value">{{ $note->updated_at->format('M d, Y - h:i A') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="meta-item">
                                    <i class="bi bi-person text-success"></i>
                                    <span class="meta-label">Author:</span>
                                    <span class="meta-value">{{ $note->user->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.note-detail-card {
    border: 1px solid rgba(255, 255, 255, 0.1);
    overflow: hidden;
}

.note-image-header {
    position: relative;
    max-height: 400px;
    overflow: hidden;
    background: linear-gradient(45deg, rgba(23, 162, 184, 0.1), rgba(255, 193, 7, 0.1));
    padding: 20px;
}

.note-full-image {
    width: 100%;
    height: auto;
    max-height: 360px;
    object-fit: cover;
    border-radius: 12px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.note-content-full {
    color: #e1e1e1;
    line-height: 1.8;
    font-size: 16px;
    text-align: justify;
    word-wrap: break-word;
    white-space: pre-wrap;
}

.note-metadata {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.02);
    margin: 0 -1.5rem -1.5rem -1.5rem;
    padding: 1.5rem;
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #b0b0b0;
    font-size: 14px;
}

.meta-item i {
    font-size: 16px;
    width: 20px;
}

.meta-label {
    font-weight: 500;
    color: #d0d0d0;
}

.meta-value {
    color: #e1e1e1;
    font-weight: 400;
}

@media (max-width: 768px) {
    .note-image-header {
        padding: 15px;
        max-height: 300px;
    }
    
    .note-full-image {
        max-height: 270px;
    }
    
    .note-content-full {
        font-size: 15px;
    }
}
</style>

@endsection