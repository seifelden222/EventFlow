@extends('layouts.app')
@section('content')
@include('layouts.navigation')



<!-- ====== Search + Create New Event ====== -->
<div class="container py-4">
    <div class="search-wrap">
        <div class="row g-2 align-items-center">
            <div class="col-md-8 position-relative">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="form-control search-box" placeholder="Search events by name, location, or tags..." />
            </div>
            <div class="col-md-4 text-md-start text-center">
                <a class="btn btn-create rounded-3" href="{{ route('events.create') }}">Create New Event</a>
            </div>
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
                    <i class="bi bi-cloud-sun"></i> Partly Cloudy
                </div>
                <div class="d-flex align-items-baseline gap-2">
                    <div class="display-6 fw-bold">24°C</div>
                    <div class="text-secondary">Clear in area</div>
                </div>
            </div>
        </aside>

        <!-- Content -->
        <section class="col-lg-9 ">
            <div class="d-flex ml-5 justify-content-center align-items-center">

                <h5 class="mb-3 mt-5 mb-5 ">Events Index Page</h5>
            </div>

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
            <div class="d-flex flex-column align-items-center mt-4">
                <div class="pager-dots mb-2">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-sm viwe px-3 rounded-3">1</button>
                    <button class="btn btn-sm viwe px-3 rounded-3">2</button>
                    <button class="btn btn-sm viwe px-3 rounded-3">3</button>
                    <button class="btn btn-sm viwe px-3 rounded-3">Next</button>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection