@extends('layouts.app')
@section('content')
@include('layouts.navigation')

<div class="container py-4">
    <div class="search-wrap mb-4">
        <div class="position-relative mx-auto" style="max-width: 700px;">
            <i class="bi bi-search search-icon position-absolute top-50 start-0 translate-middle-y ms-3 text-muted fs-5"></i>
            <input type="text" class="form-control search-box ps-5" placeholder="Search events by name, location, or tags..." />
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <button class="btn-tag btn btn-outline-primary d-flex align-items-center gap-2"><i class="bi bi-music-note-beamed"></i> Music</button>
                <button class="btn-tag btn btn-outline-secondary d-flex align-items-center gap-2"><i class="bi bi-palette"></i> Art</button>
                <button class="btn-tag btn btn-outline-success d-flex align-items-center gap-2"><i class="bi bi-utensils"></i> Food</button>
                <button class="btn-tag btn btn-outline-warning d-flex align-items-center gap-2"><i class="bi bi-mic-fill"></i> Ted</button>
                <button class="btn-tag btn btn-outline-info d-flex align-items-center gap-2"><i class="bi bi-laptop"></i> Tech</button>
                <button class="btn-tag btn btn-outline-danger d-flex align-items-center gap-2"><i class="bi bi-globe"></i> Sports</button>
                <button class="btn-tag btn btn-outline-light d-flex align-items-center gap-2"><i class="bi bi-cash"></i> Free</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row g-4 ">
        <aside class="col-lg-3">
            <div class="side-card p-3 mb-3 rounded-4 shadow-sm">
                <div class="title mb-3 fw-bold text-white fs-5">Quick Filters</div>
                <div class="side-list d-grid gap-2">
                    <a href="#" class="d-flex align-items-center gap-2 py-2 px-3 rounded-3 text-decoration-none text-white-50 hover-link"><i class="bi bi-bookmark-fill fs-5"></i><span>Saved Events</span></a>
                    <a href="#" class="d-flex align-items-center gap-2 py-2 px-3 rounded-3 text-decoration-none text-white-50 hover-link"><i class="bi bi-compass-fill fs-5"></i><span>Explore All</span></a>
                </div>
            </div>

            <div class="weather-box p-4 rounded-4 shadow-sm text-center">
                <div class="d-flex justify-content-center align-items-center gap-2 weather-badge mb-3">
                    <i class="bi bi-cloud-sun-fill fs-4 text-warning"></i>
                    <span class="text-white-75">
                        @if(isset($weather['description']) && !isset($weather['error']))
                        {{ $weather['description'] }}
                        @else
                        Partly Cloudy
                        @endif
                    </span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="display-4 fw-bold text-white mb-1">
                        @if(isset($weather['temp']) && !isset($weather['error']))
                        {{ round($weather['temp']) }}°C
                        @else
                        25°C
                        @endif
                    </div>
                    <div class="text-muted fs-6">
                        @if(isset($weather['city']) && !isset($weather['error']))
                        {{ $weather['city'] }}
                        @else
                        New York
                        @endif
                    </div>
                </div>
                @if(isset($weather['error']))
                <div class="small text-danger mt-3">{{ $weather['error'] }}</div>
                @endif
            </div>
        </aside>

        <section class="col-lg-9">
            <h5 class="mb-4 text-white fw-bold fs-4">Upcoming Events</h5>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                @forelse($events as $event)
                <div class="col">
                    <div class="card event-card shadow-sm rounded-4 h-100 d-flex flex-column">
                        <div class="p-3">
                                <div class="img-wrap rounded-3 overflow-hidden border border-2 {{ $loop->index % 3 == 0 ? 'border-info' : ($loop->index % 3 == 1 ? 'border-primary' : 'border-success') }} {{ $loop->index % 3 == 0 ? 'glow-cyan' : ($loop->index % 3 == 1 ? 'glow-purple' : 'glow-orange') }}">
                                    @php
                                    $img = $event->main_image;
                                    // Determine the correct src for the image value stored in DB
                                    if (!$img) {
                                        $src = 'https://picsum.photos/seed/event' . ($loop->index + 10) . '/800/500';
                                    } elseif (Str::startsWith($img, ['http://', 'https://'])) {
                                        $src = $img;
                                    } elseif (Str::startsWith($img, ['storage/'])) {
                                        $src = asset($img);
                                    } else {
                                        // assume it's a storage path like 'events/xxx.jpg' stored via storage path
                                        $src = asset('storage/' . ltrim($img, '/'));
                                    }
                                    @endphp

                                    <img src="{{ $src }}" alt="{{ $event->title }}" class="img-fluid" />
                                </div>
                        </div>
                        <div class="card-body pt-0 flex-grow-1">
                            <h6 class="fw-bold text-white mb-1">{{ $event->title }}</h6>
                            <p class="text-muted small mb-2"><i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('D, M d') }} • {{ $event->start_time ?? '' }}</p>
                            <p class="text-muted small line-clamp-3">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3 px-3 mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-info rounded-pill px-3 me-2">View Details</a>
                                <!-- @if(isset($event->quize) && $event->quize->is_active) {{-- Check if quiz exists and is active --}}
                                <a href="{{ route('quizes.show', $event->quize->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">Take Quiz</a>
                                @endif -->
                                <div class="ms-auto d-flex gap-2">
                                    <a class="btn btn-sm btn-outline-secondary rounded-circle icon-btn" href="#"><i class="bi bi-share-fill"></i></a>
                                    <a class="btn btn-sm btn-outline-secondary rounded-circle icon-btn" href="#"><i class="bi bi-heart-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-secondary text-center rounded-3 py-4">
                        <i class="bi bi-info-circle fs-3 mb-2 d-block"></i>
                        <p class="mb-0">No events found matching your criteria.</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if($events->hasPages())
            <div class="container mt-5">
                <div class="row">
                    <!-- <div class="col-md-6"></div> -->
                    
                    <div class="col-12 d-flex justify-content-center ">
                        <nav aria-label="Events pagination ">
                            {{ $events->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    
                    
                </div>
            </div>
            @endif

            {{-- Removed the embedded quizzes section here to avoid redundancy if it's not core --}}
            {{-- If you need it, ensure `_quiz-card` partial exists and is correctly styled --}}
            
            @php
            $embeddedQuizzes = collect();
            foreach ($events as $ev) {
                if (isset($ev->quize) && $ev->quize->is_active) {
                    $embeddedQuizzes->push($ev->quize);
                }
            }
            @endphp

            @if($embeddedQuizzes->count())
            <div class="mt-5">
                <h5 class="text-white mb-3 fw-bold fs-4">Related Quizzes</h5>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                    @foreach($embeddedQuizzes as $quiz)
                    <div class="col">
                        @include('quizes._quiz-card', ['quiz' => $quiz])
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
        </section>
    </div>
</div>

<div class="container mt-5 mb-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-white mb-0 fs-4">
                    <i class="bi bi-journal-text text-info me-2"></i> Quick Notes
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('notes.create') }}" class="btn btn-sm btn-outline-info rounded-pill px-3 d-flex align-items-center gap-1">
                        <i class="bi bi-plus"></i> Add Note
                    </a>
                    <a href="{{ route('notes.index') }}" class="btn btn-sm btn-info rounded-pill px-3 d-flex align-items-center gap-1">
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
                    <div class="card quick-note-card shadow-sm rounded-3 h-100">
                        @if($note->img)
                        <div class="p-2 pb-0">
                            <div class="quick-img-wrap rounded-2 overflow-hidden border border-secondary">
                                @php
                                $nimg = $note->img;
                                if (Str::startsWith($nimg, ['http://','https://'])) {
                                    $nsrc = $nimg;
                                } elseif (Str::startsWith($nimg, ['storage/'])) {
                                    $nsrc = asset($nimg);
                                } else {
                                    $nsrc = asset('storage/' . ltrim($nimg, '/'));
                                }
                                @endphp
                                <img src="{{ $nsrc }}" alt="Note Image" class="quick-note-image img-fluid" />
                            </div>
                        </div>
                        @endif

                        <div class="card-body {{ !$note->img ? 'pt-3' : 'py-2' }} px-3 d-flex flex-column justify-content-between">
                            <p class="quick-note-content mb-2 text-white-75 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit($note->content, 80) }}
                            </p>
                            <div class="quick-note-meta pt-2 border-top border-secondary">
                                <small class="text-muted d-block">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $note->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-0 pb-2 px-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('notes.show', $note->id) }}" class="btn-view-small text-info text-decoration-none">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a class="btn btn-xs btn-outline-warning rounded-2 icon-btn-sm" href="{{ route('notes.edit', $note->id) }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-dark rounded-3 shadow-sm">
                        <div class="quick-empty-state">
                            <i class="bi bi-journal-x fs-2 text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-3 fs-5">No notes yet</p>
                            <a href="{{ route('notes.create') }}" class="btn btn-lg btn-outline-info rounded-pill px-4 d-flex align-items-center gap-2 mx-auto justify-content-center">
                                <i class="bi bi-plus-circle"></i> Create First Note
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection