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

@endsection