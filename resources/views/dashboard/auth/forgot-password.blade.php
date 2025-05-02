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
                        <p class="text-center lead fw-bold">Forgot Password</p>
                        <hr>


                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="email" placeholder="Enter your email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           

                            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Send Reset Link</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
