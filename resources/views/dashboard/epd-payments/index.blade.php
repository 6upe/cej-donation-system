@extends('layouts.dashboard.app')

@section('content')

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold">Payments Management</h4>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle text-nowrap mb-0">
                <thead class="bg-light">
                    <tr>
                        <th>#</th>
                        <th>Participant</th>
                        <th>Transaction</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Paid At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($payments as $payment)
                    <tr>

                        <!-- ID -->
                        <td>
                            <span class="fw-semibold">#{{ $payment->id }}</span>
                        </td>

                        <!-- PARTICIPANT -->
                        <td>
                            <div>
                                <h6 class="mb-1">{{ $payment->participant->name ?? 'N/A' }}</h6>
                                <small class="text-muted">
                                    {{ $payment->participant->email ?? '-' }}
                                </small>
                            </div>
                        </td>

                        <!-- TRANSACTION -->
                        <td>
                            <div>
                                <span class="fw-semibold">
                                    {{ $payment->transaction_ref }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    {{ Str::limit($payment->transaction_token, 20) }}
                                </small>
                            </div>
                        </td>

                        <!-- AMOUNT -->
                        <td>
                            <span class="fw-bold text-success">
                                {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                            </span>
                        </td>

                        <!-- METHOD -->
                        <td>
                            @if($payment->payment_method === 'mobile')
                                <span class="badge bg-info">Mobile</span>
                                <br>
                                <small>{{ $payment->mno }}</small>
                            @elseif($payment->payment_method === 'card')
                                <span class="badge bg-primary">Card</span>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>

                        <!-- STATUS -->
                        <td>
                            @php
                                $statusColors = [
                                    'paid' => 'success',
                                    'pending' => 'warning text-dark',
                                    'failed' => 'danger'
                                ];
                            @endphp

                            <span class="badge bg-{{ $statusColors[$payment->status] ?? 'secondary' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>

                        <!-- PAID AT -->
                        <td>
                            @if($payment->paid_at)
                                <small>{{ $payment->paid_at->format('M d, Y H:i') }}</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <!-- ACTIONS -->
                        <td>
                            <button 
                                class="btn btn-sm btn-outline-primary"
                                onclick="viewPayment({{ $payment->id }})">
                                View
                            </button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-3">
            {{ $payments->links() }}
        </div>

    </div>
</div>

<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Payment Details</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="paymentDetails"></div>
        </div>
    </div>
</div>

<script>
function viewPayment(id) {
    fetch(`/api/payments/${id}`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('paymentDetails').innerHTML = `
                <pre>${JSON.stringify(data, null, 2)}</pre>
            `;

            new bootstrap.Modal(document.getElementById('paymentModal')).show();
        });
}
</script>

@endsection