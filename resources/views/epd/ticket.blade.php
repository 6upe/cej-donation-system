<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ticket - {{ $participant->name }}</title>
    <meta name="description" content="Participant ticket for event.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logos/favicon.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 15px;
        }

        .ticket-card {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .ticket-header {
            text-align: center;
            background: #0d6efd;
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .ticket-header h2 {
            margin: 0;
        }

        .ticket-body {
            padding: 15px 0;
        }

        .ticket-body p {
            margin-bottom: 10px;
        }

        .badge-status {
            padding: 5px 10px;
            font-size: 0.9rem;
        }

        .ticket-footer {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
        }

        .ticket-footer .btn {
            margin: 5px 0;
        }

        @media print {
            .ticket-footer { display: none; }
        }
    </style>
</head>

<body>
    <div class="ticket-card">
        <div class="ticket-header">
            <h2>Participant Ticket</h2>
            <p><strong>Ticket Code:</strong> {{ $participant->ticket_code }}</p>
        </div>

        <div class="ticket-body row">
            <div class="col-md-6">
                <p><strong>ID:</strong> {{ $participant->id }}</p>
                <p><strong>Name:</strong> {{ $participant->name }}</p>
                <p><strong>Email:</strong> {{ $participant->email }}</p>
                <p><strong>Phone:</strong> {{ $participant->phone }}</p>
                <p><strong>Product:</strong> {{ $participant->product }}</p>
                <p><strong>Amount:</strong> {{ number_format($participant->amount,2) }} {{ $participant->currency }}</p>
                <p><strong>Ticket Package:</strong> {{ $participant->ticket_package }}</p>
                <p><strong>Delegate Category:</strong> {{ $participant->delegate_category }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Province:</strong> {{ $participant->province }}</p>
                <p><strong>District:</strong> {{ $participant->district }}</p>
                <p><strong>Organisation:</strong> {{ $participant->organisation }}</p>
                <p><strong>Job Title:</strong> {{ $participant->job_title }}</p>
                <p><strong>Referral:</strong> {{ $participant->referral ?? 'N/A' }}</p>
                <p><strong>Transaction Token:</strong> {{ $participant->transaction_token }}</p>
                <p><strong>Payment Status:</strong>
                    <span class="badge {{ $participant->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }} badge-status">
                        {{ ucfirst($participant->payment_status) }}
                    </span>
                </p>
                <p><strong>Product Status:</strong>
                    <span class="badge {{ $participant->product_status == 'attended' ? 'bg-success' : 'bg-secondary' }} badge-status">
                        {{ ucfirst($participant->product_status) }}
                    </span>
                </p>
                <p><strong>Created At:</strong> {{ $participant->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Updated At:</strong> {{ $participant->updated_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="ticket-footer">
            <!-- Admin button (optional, visible if logged in) -->
            @auth
            <a href="{{ route('dashboard.participants.edit', $participant->id) }}" class="btn btn-outline-primary">
                Change Status
            </a>
            @endauth

            <!-- Print/Share buttons -->
            <div>
                <button class="btn btn-outline-success" onclick="window.print()">Print / Save</button>
                <a href="mailto:?subject=Participant Ticket&body=Participant: {{ $participant->name }}%0ATicket Code: {{ $participant->ticket_code }}" class="btn btn-outline-info">
                    Share via Email
                </a>
            </div>
        </div>
    </div>
</body>

</html>