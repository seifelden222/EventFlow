<div class="container-fluid p-2 topbar">
  <div class="container">
    <nav class="navbar navbar-expand">
      <a class="navbar-brand fw-bold brand" href="{{ route('events.index') }}"><i class="bi bi-cube"></i> EventFlow</a>

      <div class="ms-auto navbar-nav align-items-center">
        <a class="nav-link mx-2" href="{{ route('notes.index') }}">My Notes</a>
        <a class="nav-link mx-2" href="#">Calendar</a>
        <a class="nav-link mx-2" href="#">Explore Events</a>
        <a class="nav-link mx-2" href="#">About</a>
        @guest
        <a class="btn btn-outline-light rounded-pill ms-2 px-3" href="{{ route('login') }}">Log in</a>

        <a class="btn btn-outline-light rounded-pill ms-2 px-3" href="{{ route('register') }}">Register</a>
        @endguest

        @auth
        <a class="btn btn-outline-light rounded-pill ms-2 px-3" href="{{ route('events.create') }}">Create Event</a>
        @endauth
      </div>
    </nav>
  </div>
</div>