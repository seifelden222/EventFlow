<div class="container-fluid p-2 topbar">
    <div class="container">
        <nav class="navbar navbar-expand-lg"> {{-- Changed to navbar-expand-lg for better responsiveness --}}
            <a class="navbar-brand fw-bold btn btn-outline-info rounded-3 d-flex align-items-center gap-2" href="{{ route('events.index') }}">
                <i class="bi bi-calendar-event fs-5"></i> EventFlow {{-- Changed icon for relevance --}}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav"> {{-- Added collapse for mobile view --}}
                <div class="ms-auto navbar-nav align-items-center">
                    <a class="nav-link mx-2 d-flex align-items-center gap-1" href="{{ route('notes.index') }}"><i class="bi bi-journal-text"></i> My Notes</a>
                    <a class="nav-link mx-2 d-flex align-items-center gap-1" href="{{ route('quizes.index') }}"><i class="bi bi-question-circle"></i> Quizzes</a>
                    <a class="nav-link mx-2 d-flex align-items-center gap-1" href="#"><i class="bi bi-compass"></i> Explore Events</a>
                    <a class="nav-link mx-2 d-flex align-items-center gap-1" href="#"><i class="bi bi-info-circle"></i> About</a>
                    @guest
                    <a class="btn btn-outline-light rounded-pill ms-lg-2 px-3 btn-sm" href="{{ route('login') }}">Log in</a>
                    <a class="btn btn-outline-light rounded-pill ms-lg-2 px-3 btn-sm" href="{{ route('register') }}">Register</a> {{-- Made register solid for prominence --}}
                    <!-- <a class="btn btn-info rounded-pill ms-2 px-3 btn-sm" href="{{ route('register') }}">Register</a> {{-- Made register solid for prominence --}} -->
                    @endguest

                    @auth
                    <a class="btn btn-info rounded-pill ms-lg-2 px-3 btn-sm d-flex align-items-center gap-1" href="{{ route('events.create') }}">
                        <i class="bi bi-plus-circle"></i> Create Event
                    </a>
                     <!-- Optionally, add a dropdown for authenticated users -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>