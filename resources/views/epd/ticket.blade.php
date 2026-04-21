<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>EPD Participant Ticket - {{ $participant->name }}</title>

<!-- SEO Meta -->
<meta name="description" content="Official participant ticket for {{ $participant->name }} attending the EPD Event. Includes ticket code, payment status, and event details.">
<meta name="keywords" content="EPD Event, Participant Ticket, Conference, {{ $participant->ticket_package }}, {{ $participant->delegate_category }}">

<!-- Author -->
<meta name="author" content="Centre for Environment Justice (CEJ)">

<!-- Open Graph / Social Sharing -->
<meta property="og:title" content="EPD Participant Ticket - {{ $participant->name }}">
<meta property="og:description" content="Official participant ticket for {{ $participant->name }} attending the EPD Event.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('assets/images/logos/cej-logo.png') }}">
<meta property="og:site_name" content="Centre for Environment Justice (CEJ)">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="EPD Participant Ticket - {{ $participant->name }}">
<meta name="twitter:description" content="Official participant ticket for {{ $participant->name }} attending the EPD Event.">
<meta name="twitter:image" content="{{ asset('assets/images/logos/cej-logo.png') }}">
<meta name="twitter:site" content="@CEJZambia">

<!-- Favicon -->
<link rel="icon" href="{{ asset('assets/images/logos/cej-favicon.png') }}" type="image/png">
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    .ticket-box {
        max-width: 850px;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .ticket-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .ticket-header img {
        max-width: 90px;
        margin-bottom: 10px;
    }

    .ticket-code {
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        padding: 12px 0;
        background: #ecf0f1;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .status-badge {
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.9rem;
        color: #fff;
    }

    .paid { background-color: #28a745; }
    .pending { background-color: #f39c12; }
    .attended { background-color: #28a745; }
    .not-attended { background-color: #7f8c8d; }

    @media print {
        .actions { display: none; }
    }

    .card-header {
        font-weight: 600;
        font-size: 16px;
    }
</style>
</head>
<body>

<div class="ticket-box">

    <!-- Header -->
    <div class="ticket-header">
        <img src="{{ asset('assets/images/logos/cej-logo.png') }}" alt="Logo">
        <h2>Participant Veri-Ticket</h2>
        <p class="text-muted mb-1"><strong>Centre for Environment Justice (CEJ)</strong></p>
        <small class="text-danger">This is not an Official Ticket</small>
    </div>

    <!-- Ticket Code -->
    <div class="ticket-code bg-success text-white">
        {{ $participant->ticket_code }}
    </div>

    <!-- Personal Info Card -->
    <div class="card mb-3">
        <div class="card-header bg-light">Participant Information</div>
        <div class="card-body">
            <div class="row mb-2"><div class="col-4 fw-bold">Name:</div><div class="col-8">{{ $participant->name }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Email:</div><div class="col-8">{{ $participant->email }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Phone:</div><div class="col-8">{{ $participant->phone }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Organisation:</div><div class="col-8">{{ $participant->organisation }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Job Title:</div><div class="col-8">{{ $participant->job_title }}</div></div>
                        <div class="row mb-2"><div class="col-4 fw-bold">Province:</div><div class="col-8">{{ $participant->province }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">District:</div><div class="col-8">{{ $participant->district }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Referral:</div><div class="col-8">{{ $participant->referral ?? 'N/A' }}</div></div>
        </div>
    </div>

    <!-- Event Info Card -->
    <div class="card mb-3">
        <div class="card-header bg-light">Event Details</div>
        <div class="card-body">
            <div class="row mb-2"><div class="col-4 fw-bold">Product:</div><div class="col-8">{{ $participant->product }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Ticket Package:</div><div class="col-8">{{ $participant->ticket_package }}</div></div>
            <div class="row mb-2"><div class="col-4 fw-bold">Delegate Category:</div><div class="col-8">{{ $participant->delegate_category }}</div></div>
        </div>
    </div>

    <!-- Payment & Status Card -->
    <div class="card mb-3">
        <div class="card-header bg-light">Payment & Status</div>
        <div class="card-body">
            <div class="row mb-2"><div class="col-4 fw-bold">Amount:</div><div class="col-8">{{ number_format($participant->amount, 2) }} {{ $participant->currency }}</div></div>
            <!-- <div class="row mb-2"><div class="col-4 fw-bold">Transaction Token:</div><div class="col-8">{{ $participant->transaction_token }}</div></div> -->
            <div class="row mb-2"><div class="col-4 fw-bold">Payment Status:</div>
                <div class="col-8">
                    <span class="status-badge {{ $participant->payment_status == 'paid' ? 'paid' : 'pending' }}">
                        {{ ucfirst($participant->payment_status) }}
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-4 fw-bold">Product Status:</div>
                <div class="col-8">
                    @php
                        $statuses = $participant->product_status ?? [];
                    @endphp

                    @foreach($statuses as $status)
                        <span class="status-badge 
                            {{ $status == 'attended' ? 'attended' : '' }}
                            {{ $status == 'registered' ? 'registered' : '' }}
                            {{ $status == 'collected' ? 'collected' : '' }}
                            {{ $status == 'cancelled' ? 'cancelled' : '' }}">
                            
                            {{ ucfirst($status) }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="actions d-flex justify-content-end flex-wrap gap-2 mb-3">
        @auth
        <a href="{{ route('dashboard.scanner', $participant->id) }}" class="btn btn-xs btn-dark"><i class="bi bi-pencil-square"></i> Change Status</a>
        @endauth
        <button class="btn btn-xs btn-success" onclick="window.print()"><i class="bi bi-printer"></i> Print / Save</button>
    </div>

    <!-- Footer -->
    <div class="text-center text-muted small mt-3">
        &copy; 2026 Centre for Environment Justice. All rights reserved. <br>
        For more info, visit <a href="https://cejzambia.org">cejzambia.org</a>
    </div>

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>