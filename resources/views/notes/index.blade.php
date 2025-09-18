@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<!-- ====== Header + Create New Note ====== -->
<div class="container py-4">
    <div class="search-wrap">
        <div class="row g-2 align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <h4 class="mb-0 text-white">📝 My Notes</h4>
                    <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-light rounded-3">
                        <i class="bi bi-calendar-event"></i> Back to Events
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-md-end text-center">
                <a class="btn btn-create rounded-3" href="{{ route('notes.create') }}">
                    <i class="bi bi-plus-lg"></i> Create New Note
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ====== Main Content ====== -->
<div class="container mt-4">
    <div class="row g-4">
        
        @if($notes->count() > 0)
            @foreach($notes as $note)
            <div class="col-lg-4 col-md-6">
                <div class="card card-dark shadow rounded-4 h-100 note-card">
                    @if($note->img)
                    <div class="p-3 pb-0">
                        <div class="img-wrap border border-2 border-info glow-cyan">
                            <img src="{{ asset('storage/'.$note->img) }}" alt="Note Image" class="note-image" />
                        </div>
                    </div>
                    @endif
                    
                    <div class="card-body {{ !$note->img ? 'pt-4' : '' }}">
                        <div class="note-content">
                            {{ \Illuminate\Support\Str::limit($note->content, 150) }}
                        </div>
                        <div class="note-meta mt-3">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i> 
                                {{ $note->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-transparent border-0 pb-3 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('notes.show', $note->id) }}" class="btn-view">
                                <i class="bi bi-eye"></i> View Full
                            </a>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-outline-warning rounded-3" href="{{ route('notes.edit', $note->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this note?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-3">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-journal-x display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">No Notes Yet</h5>
                        <p class="text-muted">Start by creating your first note!</p>
                        <a href="{{ route('notes.create') }}" class="btn btn-create rounded-3 mt-3">
                            <i class="bi bi-plus-lg"></i> Create First Note
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- ====== Pagination ====== -->
@if($notes->hasPages())
<div class="container mt-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-cente ">
            <nav aria-label="Notes pagination">
                {{ $notes->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
</div>
@endif

<style>
.note-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.note-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.note-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
}

.note-content {
    color: #e1e1e1;
    line-height: 1.6;
    font-size: 14px;
}

.note-meta {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 12px;
}

.empty-state {
    max-width: 400px;
    margin: 0 auto;
}

.btn-view {
    color: #17a2b8;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.btn-view:hover {
    color: #20c997;
}
</style>

@endsection