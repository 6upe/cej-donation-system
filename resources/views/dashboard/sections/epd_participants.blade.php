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

                <div class="col-lg-2">
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
                            <h6>Paid</h6>
                            <h4>{{ \App\Models\Participant::where('payment_status','paid')->count() }}</h4>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card p-3">
                            <h6>Pending</h6>
                            <h4>{{ \App\Models\Participant::where('payment_status','pending')->count() }}</h4>
                        </div>
                    </div>

                    
                </div>



                <div class="table-responsive">
<form method="GET" action="{{ route('dashboard.epdParticipants.search') }}">
    <div class="row mb-3">

        <!-- SEARCH INPUT -->
        <div class="col-md-4 mb-1 mt-1">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Search name, email, ticket code..."
                value="{{ request('search') }}">
        </div>



        <!-- FILTER: PAYMENT STATUS -->
        <div class="col-md-3 mb-1 mt-1">
            <select name="payment_status" class="form-select">
                <option value="">All Status</option>
                <option value="paid" {{ request('payment_status')=='paid' ? 'selected' : '' }}>Paid</option>
                <option value="pending" {{ request('payment_status')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ request('payment_status')=='failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <!-- FILTER: PACKAGE -->
        <div class="col-md-3 mb-1 mt-1">
            <select name="package" class="form-select">
                <option value="">All Packages</option>
                <option value="standard">Standard</option>
                <option value="vip">VIP</option>
            </select>
        </div>

        <!-- SUBMIT -->
        <div class="col-md-2 mb-1 mt-1">
            <button class="btn btn-primary w-100">Search</button>
        </div>

        <button onclick="verifyAllPayments()" class="btn btn-warning">
            🔄 Sync Payments
        </button>

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
                            <tr>
                                <td>
                                    <h6 class="fw-semibold mb-0">{{ $participant->id }}</h6>
                                </td>

                                <!-- NAME + EMAIL -->
                                <td>
                                    <h6 class="fw-semibold mb-1">{{ $participant->name }}</h6>
                                    <span class="fw-normal">{{ $participant->email }}</span>
                                </td>

                                <!-- PACKAGE -->
                                <td>
                                    <span class="badge bg-light-primary text-primary">
                                        {{ $participant->ticket_package }}
                                    </span>
                                </td>

                                <!-- AMOUNT -->
                                <td>
                                    <h6 class="fw-semibold mb-0">
                                        {{ $participant->currency }}
                                        {{ number_format($participant->amount, 2) }}
                                    </h6>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    @if($participant->payment_status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                    @elseif($participant->payment_status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                    <span class="badge bg-danger">Failed</span>
                                    @endif
                                </td>

                                <!-- DATE -->
                                <td>
                                    <p class="mb-0 fw-normal">
                                        {{ $participant->created_at->format('M d, Y') }}
                                    </p>
                                </td>

                                
                            <!-- TICKET CODE -->
                                <td class="flex justify-center align-content-center">
                                    <p class="mb-0 fw-normal">
                                        {{ $participant->ticket_code }}
                                    </p>
                                    <a target="_blank()" href="{{ route('ticket.show', $participant->ticket_code) }}" class="btn btn-sm w-100 btn-primary">
                                        View Ticket
                                    </a>
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

document.querySelector('input[name="search"]').addEventListener('keyup', function () {
    clearTimeout(timer);

    timer = setTimeout(() => {
        this.form.submit();
    }, 1500); // delay to avoid too many requests
});

function verifyAllPayments() {
    Swal.fire({
        title: "Are you sure?",
        text: "This will verify all payments",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, sync"
    }).then((result) => {
        if (result.isConfirmed) {

            fetch('/verify-all-payments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire("Done", data.message, "success");
            });

        }
    });
}
</script>

@endsection