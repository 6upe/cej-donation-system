@extends('layouts.dashboard.app')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body p-4">

                <h5 class="card-title fw-semibold mb-4">QR Code Scanner</h5>

                <!-- CAMERA -->
                <div id="reader" style="width:100%; max-width:500px;"></div>

                <!-- RESULT -->
                <div id="result" class="mt-4" style="display:none;">
                    <div class="card p-3">

                        <h6 class="fw-semibold">Participant Found</h6>

                        <p><strong>Name:</strong> <span id="p_name"></span></p>
                        <p><strong>Email:</strong> <span id="p_email"></span></p>
                        <p><strong>Package:</strong> <span id="p_package"></span></p>

                        <!-- STATUS UPDATE -->
                        <select id="status" class="form-select mb-3">
                            <option value="registered">Registered</option>
                            <option value="attended">Attended</option>
                            <option value="collected">Collected</option>
                            <option value="cancelled">Cancelled</option>
                        </select>

                        <button onclick="updateStatus()" class="btn btn-success">
                            Update Status
                        </button>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- QR LIBRARY -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let ticket_code = null;
let participant_id = null;

// Start scanner
function onScanSuccess(decodedText) {
    console.log("QR Data:", decodedText);
    // alert("QR Code Scanned: " + decodedText);

    const parts = decodedText.split('/');
    ticket_code = parts[parts.length - 1];

    fetchParticipant(ticket_code);
}

// Fetch participant details
function fetchParticipant(id) {
    fetch(`/api/epd-participants/${id}`, {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
        .then(res => res.json())
        .then(data => {
            document.getElementById('result').style.display = 'block';

            console.log("Participant Data:", data);

            document.getElementById('p_name').innerText = data.data.name;
            document.getElementById('p_email').innerText = data.data.email;
            document.getElementById('p_package').innerText = data.data.ticket_package;
            participant_id = data.data.id;

            document.getElementById('status').value = data.data.product_status;
        });
}

// Update status
function updateStatus() {
    const status = document.getElementById('status').value;

    fetch('/dashboard/epd-participants/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            participant_id: participant_id,
            status: status
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    });
}

// Init scanner
const html5QrCode = new Html5Qrcode("reader");

Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length) {
        html5QrCode.start(
            devices[0].id,
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        );
    }
});
</script>

@endsection