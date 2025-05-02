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
                        <p class="text-center lead fw-bold">Email Sent, Please Check your Email.</p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
