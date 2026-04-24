@extends('layouts.dashboard.app')

@section('content')

<div class="row mb-4">
    <div class="col-lg-12 d-flex justify-content-between">
        <div>
            <h4 class="fw-bold">Reconciliation Dashboard</h4>
            <p class="text-muted mb-0">Compare and reconcile payment records</p>
        </div>


        <div>
            <button onclick="runReconciliation()" class="btn btn-primary">
                Run Reconciliation
            </button>

            <!-- <button onclick="verifyDPO()" class="btn btn-warning">
                Verify With DPO
            </button> -->
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <div id="results"></div>

    </div>
</div>

<script>
function runReconciliation() {

    showLoader("Comparing records...");

    fetch('/dashboard/reconciliation/run', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            hideLoader();
            renderResults(data.data);
        });
}

function verifyDPO() {

    showLoader("Verifying with DPO...");

    // fetch('/dashboard/reconciliation/verify-dpo', {
    //         method: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         }
    //     })
    //     .then(res => res.json())
    //     .then(data => {
    //         hideLoader();
    //         renderDPOResults(data.data);
    //     });

    hideLoader();
}

function renderResults(data) {

    let html = `<table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Token</th>
                <th>Participant Status</th>
                <th>Payment Status</th>
                <th>Issues</th>
            </tr>
        </thead>
        <tbody>`;

    data.forEach(row => {

        let issues = row.issues.length ?
            `<span class="badge bg-danger">${row.issues.join(', ')}</span>` :
            `<span class="badge bg-success">OK</span>`;

        html += `
        <tr>
            <td>${row.participant.name}</td>
            <td>${row.participant.transaction_token}</td>
            <td>${row.participant.payment_status}</td>
            <td>${row.payment ? row.payment.status : 'N/A'}</td>
            <td>${issues}</td>
        </tr>`;
    });

    html += `</tbody></table>`;

    document.getElementById('results').innerHTML = html;
}

function renderDPOResults(data) {

    let html = `<table class="table table-bordered">
        <thead>
            <tr>
                <th>Token</th>
                <th>Local Status</th>
                <th>DPO Status</th>
                <th>Match</th>
            </tr>
        </thead>
        <tbody>`;

    data.forEach(row => {

        let matchBadge = row.match ?
            `<span class="badge bg-success">Match</span>` :
            `<span class="badge bg-danger">Mismatch</span>`;

        html += `
        <tr>
            <td>${row.token}</td>
            <td>${row.local_status}</td>
            <td>${row.dpo_status}</td>
            <td>${matchBadge}</td>
        </tr>`;
    });

    html += `</tbody></table>`;

    document.getElementById('results').innerHTML = html;
}
</script>

@endsection