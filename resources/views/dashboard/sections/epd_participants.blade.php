@extends('layouts.dashboard.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card w-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold mb-0">Participants</h5>
                </div>

                <div class="row mb-4">

                    <!-- TOTAL REVENUE -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <div>
                                    <h6 class="text-muted mb-2">Total Revenue</h6>
                                    <h3 class="fw-bold text-success">
                                        ZMW {{ number_format($totalPaidAmount, 2) }}
                                    </h3>
                                    <small class="text-muted">From paid participants</small>
                                </div>

                                <div class="mt-auto text-end">
                                    <a href="{{ route('dashboard.epdPayments') }}" class="btn btn-outline-primary">
                                        View Payments
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TOTAL PAID PARTICIPANTS -->
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="text-muted mb-2">Paid Participants</h6>
                                <h3 class="fw-bold text-primary">
                                    {{ $totalPaidCount }}
                                </h3>
                                <small class="text-muted">Completed payments</small>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-lg-5">
                        <div class="card p-3">
                            <a href="{{ route('dashboard.scanner') }}" class="btn btn-outline-success m-1">
                                <i class="ti ti-qrcode"></i> Scan QR Code
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card p-3">
                            <h6>Total Participants</h6>
                            <h4>{{ $participants->total() }}</h4>
                        </div>
                    </div>



                    <div class="col-lg-3">
                        <div class="card p-3">
                            <h6>Pending</h6>
                            <h4>{{ \App\Models\Payment::where('status','pending')->count() }}</h4>
                        </div>
                    </div>


                </div>



                <div class="table-responsive">
                    <form method="GET" action="{{ route('dashboard.epdParticipants.search') }}">
                        <div class="row mb-3">

                            <!-- SEARCH INPUT -->
                            <div class="col-md-4 mb-1 mt-1">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search name, email, ticket code..." value="{{ request('search') }}">
                            </div>



                            <!-- FILTER: PAYMENT STATUS -->
                            <div class="col-md-3 mb-1 mt-1">
                                <select name="payment_status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="paid" {{ request('payment_status')=='paid' ? 'selected' : '' }}>Paid
                                    </option>
                                    <option value="pending"
                                        {{ request('payment_status')=='pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="failed" {{ request('payment_status')=='failed' ? 'selected' : '' }}>
                                        Failed</option>
                                </select>
                            </div>

                            <!-- FILTER: PACKAGE -->
                            <div class="col-md-3 mb-1 mt-1">
                                <select name="package" class="form-select">
                                    <option value="">All Packages</option>
                                    <option value="standard">Standard</option>
                                    <option value="corporate">Corporate</option>
                                </select>
                            </div>

                            <!-- SUBMIT -->
                            <div class="col-md-2 mb-1 mt-1">
                                <button class="btn btn-primary w-100">Search</button>
                            </div>

                            <!-- <button onclick="verifyAllPayments()" class="btn btn-warning">
            🔄 Sync Payments
        </button> -->

                        </div>
                    </form>

                    <table class="table text-nowrap mb-0 align-middle">

                        <thead class="text-dark fs-4">
                            <tr>
                                <th>#</th>
                                <th>Participant</th>
                                <th>Package</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Ticket Code</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($participants as $participant)
                            <tr class="align-middle">

                                <!-- ID -->
                                <td class="text-muted fw-semibold">
                                    #{{ $participant->id }}
                                </td>

                                <!-- NAME + EMAIL -->
                                <td>
                                    <div class="fw-semibold">{{ $participant->name }}</div>
                                    <small class="text-muted">{{ $participant->email }}</small>
                                </td>

                                <!-- PACKAGE -->
                                <td>
                                    <span class="badge bg-light text-primary border">
                                        {{ $participant->ticket_package }}
                                    </span>
                                </td>

                                <!-- AMOUNT -->
                                <td class="fw-semibold">
                                    {{ $participant->currency }} {{ number_format($participant->amount, 2) }}
                                </td>

                                <!-- STATUS -->
                                @php
                                $statusColors = [
                                'initial' => 'secondary',
                                'registered' => 'info',
                                'attended' => 'success',
                                'collected' => 'primary',
                                'cancelled' => 'danger',
                                'paid' => 'success',
                                'pending' => 'warning text-dark',
                                'failed' => 'danger'
                                ];

                                $productStatuses = $participant->product_status ?? [];

                                if (is_string($productStatuses)) {
                                $decoded = json_decode($productStatuses, true);
                                $productStatuses = is_array($decoded) ? $decoded : [$productStatuses];
                                }

                                $allStatuses = array_unique(array_merge(
                                [$participant->payment_status],
                                $productStatuses
                                ));
                                @endphp

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($productStatuses as $status)
                                        <span class="badge bg-{{ $statusColors[$status] ?? 'secondary' }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>

                                <!-- DATE -->
                                <td class="text-muted">
                                    {{ $participant->created_at->format('M d, Y') }}
                                </td>

                                <!-- TICKET + ACTIONS -->
                                <td style="min-width: 220px;">

                                    <div class="mb-1 text-truncate">
                                        <span class="fw-semibold">{{ $participant->ticket_code }}</span>
                                    </div>

                                    <div class="d-flex flex-column gap-1">

                                        <div class="row">

                                            <div class="col-6">
                                                <a target="_blank"
                                                    href="{{ route('ticket.show', $participant->ticket_code) }}"
                                                    class="btn btn-sm btn-outline-primary w-100">
                                                    View <i class="ti ti-eye"></i>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button
                                                    onclick="resendTicket({{ $participant->id }}, '{{ $participant->ticket_code }}')"
                                                    class="btn btn-sm btn-outline-success w-100 col-6">
                                                    Re-send <i class="ti ti-send"></i>
                                                </button>
                                            </div>


                                        </div>


                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="mt-3">
                    {{ $participants->links() }}
                </div>

            </div>
        </div>
    </div>
</div>


<script>
let timer;

document.querySelector('input[name="search"]').addEventListener('keyup', function() {
    clearTimeout(timer);

    timer = setTimeout(() => {
        this.form.submit();
    }, 3000); // delay to avoid too many requests
});

function resendTicket(participantId, ticketCode) {

 showLoader("Resending ticket - " + ticketCode);

    fetch('/dashboard/resend-ticket', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                participant_id: participantId,
                ticket_code: ticketCode
            })
        })
        .then(res => res.json())
        .then(data => {
            hideLoader();

            console.log("Resend Ticket Response:", data);

            if (data.status === 'success') {
                Swal.fire("Success", data.message, "success");
            } else {
                Swal.fire("Error", data.message, "error");
            }
        });
}

// function verifyAllPayments() {
//     Swal.fire({
//         title: "Are you sure?",
//         text: "This will verify all payments",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Yes, sync"
//     }).then((result) => {
//         if (result.isConfirmed) {

//             fetch('/verify-all-payments', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                 }
//             })
//             .then(res => res.json())
//             .then(data => {
//                 Swal.fire("Done", data.message, "success");
//             });

//         }
//     });
// }
</script>

@endsection