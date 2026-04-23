@extends('layouts.auth.app')

@section('content')
<div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-6 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('assets/images/logos/cej-logo.png') }}" width="70" alt="Logo">
                        </a>
                        <p class="text-center lead fw-bold">Login to Dashboard User</p>
                        <hr>


                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label text-dark" for="remember">
                                        Remember this Device
                                    </label>
                                </div>
                                <a class="text-primary fw-bold" href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>

                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">Register Admin?</p>
                                <a class="text-primary fw-bold ms-2" href="{{ route('auth.register') }}">Create Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            showLoader("Logging in...");
        });
        hideLoader();
    });
</script>

@endsection
