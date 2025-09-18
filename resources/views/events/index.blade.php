@extends('layouts.app')
@section('content')
@include('layouts.navigation')



<!-- ====== Search + Create New Event ====== -->
<div class="container py-4">
    <div class="search-wrap">
        <div class="row g-2 d-flex justify-content-center align-items-center">
            <div class="col-md-8 position-relative">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="form-control search-box" placeholder="Search events by name, location, or tags..." />
            </div>
            <!-- <div class="col-md-4 text-md-start text-center">
                <div class="d-flex gap-2 justify-content-center justify-content-md-start">
                    <a class="btn btn-outline-info rounded-3 ms-5" href="{{ route('notes.index') }}">
                        <i class="bi bi-journal-text"></i> My Notes
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!-- ====== Tags ====== -->
<div class="container">
    <div class="row">
        <div class="col text-md-start text-center">
            <div class="mt-2 d-flex flex-wrap btns justify-content-center ">
                <button class="btn-tag btn btn-orange">Music</button>
                <button class="btn-tag btn btn-purple">Art</button>
                <button class="btn-tag btn btn-yellow">Food</button>
                <button class="btn-tag btn btn-cyan">Ted</button>
                <button class="btn-tag btn btn-teal">Tech</button>
                <button class="btn-tag btn btn-lime">Sports</button>
                <button class="btn-tag btn btn-blue">Free</button>
            </div>
        </div>
    </div>
</div>

<!-- ====== Main: Sidebar + Cards ====== -->
<div class="container mt-4">
    <div class="row g-4 ">
        <!-- Sidebar -->
        <aside class="col-lg-3">
            <div class="side-card p-3 mb-3">
                <div class="title mb-2">Quick Filters</div>
                <div class="side-list d-grid">
                    <a href="#"><i class="bi bi-bookmark"></i><span>Saved</span></a>
                    <a href="#"><i class="bi bi-compass"></i><span>Explore</span></a>
                </div>
            </div>

            <div class="weather-box">
                <div class="d-flex align-items-center gap-2 weather-badge mb-3">
                    <i class="bi bi-cloud-sun"></i>
                    @if(isset($weather['description']) && !isset($weather['error']))
                    {{ $weather['description'] }}
                    @else
                    Partly Cloudy
                    @endif
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <div class="display-6 fw-bold">
                        @if(isset($weather['temp']) && !isset($weather['error']))
                        {{ round($weather['temp']) }}°C
                        @else
                        25°C
                        @endif
                    </div>
                    <div class="text-secondary">
                        @if(isset($weather['city']) && !isset($weather['error']))
                        {{ $weather['city'] }}
                        @else
                        {{ $city }}
                        @endif
                    </div>
                </div>
                @if(isset($weather['error']))
                <div class="small text-warning mt-1">{{ $weather['error'] }}</div>
                @endif
            </div>
        </aside>

        <!-- Content -->
        <section class="col-lg-9 mt-5">
            <!-- <div class="d-flex ml-5 justify-content-center align-items-center">

                <h5 class="mb-3 mt-5 mb-5 ">Events Index Page</h5>
            </div> -->

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                @forelse($events as $event)
                <div class="col">
                    <div class="card card-dark shadow rounded-4 h-100 d-flex flex-column">
                        <div class="p-3">
                            <div class="img-wrap border border-2 border-info {{ $loop->index % 3 == 0 ? 'glow-cyan' : ($loop->index % 3 == 1 ? 'glow-pink' : 'glow-orange') }}">
                                <img src="{{ $event->main_image ? asset('storage/'.$event->main_image) : 'https://picsum.photos/800/500?random=' . ($loop->index + 10) }}" alt="{{ $event->title }}" />
                            </div>
                        </div>
                        <div class="card-body pt-0 flex-grow-1">
                            <p class="fw-bold text-white mb-1 fs-5">{{ $event->title }}</p>
                            <p class="muted small mb-2">{{ \Carbon\Carbon::parse($event->event_date)->format('D, M d') }} • {{ $event->start_time ?? '' }}</p>
                            <p class="muted" style="letter-spacing:.4px;line-height:22px">{{ \Illuminate\Support\Str::limit($event->description, 140) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3 px-3 mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('events.show', $event) }}" class="btn-view" style="text-decoration: none;">View Details</a>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-outline-secondary rounded-3" href="#"><i class="bi bi-share"></i></a>
                                    <a class="btn btn-sm btn-outline-secondary rounded-3" href="#"><i class="bi bi-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-secondary">No events found.</div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($events->hasPages())

            <div class="container mt-4">
                <div class="row">
                    <div class="col-12 d-flex justify-content-cente ">
                        <nav aria-label="Notes pagination">
                            {{ $events->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            </div>
            @endif
        </section>
    </div>
</div>

<!-- ====== Quick Notes Section ====== -->
<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-white mb-0">
                    <i class="bi bi-journal-text text-info"></i> Quick Notes
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('notes.create') }}" class="btn btn-sm btn-outline-info rounded-3">
                        <i class="bi bi-plus"></i> Add Note
                    </a>
                    <a href="{{ route('notes.index') }}" class="btn btn-sm btn-info rounded-3">
                        <i class="bi bi-list"></i> View All
                    </a>
                </div>
            </div>

            <div class="row g-3">
                @php
                $quickNotes = \App\Models\Notes::with('user')->orderBy('created_at', 'desc')->limit(3)->get();
                @endphp

                @forelse($quickNotes as $note)
                <div class="col-lg-4 col-md-6">
                    <div class="card card-dark shadow rounded-3 h-100 quick-note-card">
                        @if($note->img)
                        <div class="p-2 pb-0">
                            <div class="quick-img-wrap">
                                <img src="{{ asset('storage/'.$note->img) }}" alt="Note Image" class="quick-note-image" />
                            </div>
                        </div>
                        @endif

                        <div class="card-body {{ !$note->img ? 'pt-3' : 'py-2' }} px-3">
                            <div class="quick-note-content">
                                {{ \Illuminate\Support\Str::limit($note->content, 80) }}
                            </div>
                            <div class="quick-note-meta mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i>
                                    {{ $note->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-0 pb-2 px-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('notes.show', $note->id) }}" class="btn-view-small">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a class="btn btn-xs btn-outline-warning rounded-2" href="{{ route('notes.edit', $note->id) }}">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-3">
                        <div class="quick-empty-state">
                            <i class="bi bi-journal-x h4 text-muted mb-2"></i>
                            <p class="text-muted mb-2">No notes yet</p>
                            <a href="{{ route('notes.create') }}" class="btn btn-sm btn-outline-info rounded-3">
                                <i class="bi bi-plus"></i> Create First Note
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .quick-note-card {
        transition: transform 0.2s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        max-height: 280px;
    }

    .quick-note-card:hover {
        transform: translateY(-2px);
    }

    .quick-img-wrap {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .quick-note-image {
        width: 100%;
        height: 100px;
        object-fit: cover;
    }

    .quick-note-content {
        color: #e1e1e1;
        line-height: 1.4;
        font-size: 13px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .quick-note-meta {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 8px;
    }

    .btn-view-small {
        color: #17a2b8;
        text-decoration: none;
        font-weight: 500;
        font-size: 12px;
        transition: color 0.2s ease;
    }

    .btn-view-small:hover {
        color: #20c997;
    }

    .btn-xs {
        padding: 2px 6px;
        font-size: 11px;
    }

    .quick-empty-state {
        max-width: 300px;
        margin: 0 auto;
    }
</style>

@endsection