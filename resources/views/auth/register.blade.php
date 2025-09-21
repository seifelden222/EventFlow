@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card card-dark shadow rounded-4">
                <div class="card-body px-5 py-4">
                    <h3 class="mb-3 text-white">Create your EventFlow account</h3>
                    @include('partials.alerts')

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label text-muted">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-control form-control-dark" />
                            @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control form-control-dark" />
                            @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Password</label>
                            <input id="password" type="password" name="password" required class="form-control form-control-dark" />
                            @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control form-control-dark" />
                            @error('password_confirmation')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <a href="{{ route('events.index') }}" class="btn btn-outline-light">Back to Events</a>
                            </div>
                            <div class="d-grid" style="width: 45%">
                                <button class="btn btn-success btn-lg rounded-3">Create account</button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-info">Sign in</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
