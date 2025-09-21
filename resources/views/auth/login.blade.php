@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card card-dark shadow rounded-4">
                <div class="card-body px-5 py-4">
                    <h3 class="mb-3 text-white">Sign in to EventFlow</h3>
                    @include('partials.alerts')

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control form-control-dark" />
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Password</label>
                            <input id="password" type="password" name="password" required class="form-control form-control-dark" />
                            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <input id="remember_me" type="checkbox" name="remember" class="form-check-input me-2" />
                                <label for="remember_me" class="form-check-label text-muted">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-info small">Forgot password?</a>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg rounded-3">Log in</button>
                        </div>
                    </form>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <a href="{{ route('events.index') }}" class="btn btn-outline-light">Back to Events</a>
                            </div>
                            <div>
                                <small class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-info">Create one</a></small>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
