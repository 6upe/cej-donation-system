@extends('layouts.dashboard.app')

@section('content')

<style>

    .status-option {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    cursor: pointer;
    user-select: none;
}

.status-option input {
    display: none;
}

.status-option.active {
    background: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
</style>

<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body p-4">

            <div class="mt-3 mb-3">
                <input type="text" id="manualTicket" class="form-control mb-2"
                    placeholder="Enter or scan ticket code manually">

                <button class="btn btn-dark w-100" onclick="searchByTicket()">
                    Search Participant
                </button>
            </div>

                <h5 class="card-title fw-semibold mb-4">QR Code Scanner</h5>
                <p class="text-warning">Point the camera at the QR code on the participant's ticket to view their details and update their status. </p>

                <div class="row">

                     <!-- RESULT -->
                    <div id="result" class="col-md-6 col-lg-6 col-sm-10 col-xs-12 mt-4" style="display:none;">
                        
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-10 col-xs-12 alert alert-info">
                        <!-- CAMERA -->
                        <div class="mb-3">
                            <button id="flipCameraBtn" class="btn btn-primary">Flip Camera</button>
                        </div>
                        <div id="reader" class="w-100"></div>
                    </div>
                   
                </div>
            </div>
        </div>

    </div>
</div>

<!-- QR LIBRARY -->
<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

function fetchParticipant(id) {
    fetch(`/api/epd-participants/${id}`, {
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {

        if (!data.data) {
            document.getElementById('result').style.display = 'block';
            document.getElementById('result').innerHTML = `
                <div class="alert alert-danger">
                    Participant not found for ticket code: ${ticket_code}
                </div>
            `;
            return;
        }

        console.log("Participant Data:", data.data);

        let statuses = data.data.product_status;

        // If it's a string (most likely case in your system)
        if (typeof statuses === 'string') {
            try {
                statuses = JSON.parse(statuses);
            } catch (e) {
                statuses = [statuses]; // fallback
            }
        }

        // If it's null/undefined
        if (!Array.isArray(statuses)) {
            statuses = [];
        }

        const statusBadges = statuses.length
            ? statuses.map(status => {
                const colors = {
                    initial: 'secondary',
                    registered: 'info',
                    attended: 'success',
                    collected: 'primary',
                    cancelled: 'danger',
                    paid: 'success'
                };

                return `
                    <span class="badge bg-${colors[status] || 'secondary'} me-1 mb-1">
                        ${status.charAt(0).toUpperCase() + status.slice(1)}
                    </span>
                `;
            }).join('')
            : `<span class="badge bg-light text-dark">No status</span>`;

        participant_id = data.data.id;

        // 1. FIRST render UI
        document.getElementById('result').style.display = 'block';
        document.getElementById('result').innerHTML = `
            <div class="card p-3">
                <div class="alert alert-success">
                    <h5 class="mb-1">Participant: ${data.data.name}</h5>
                    <small>Ticket: ${data.data.ticket_code}</small>
                </div>

                <p><strong>Name:</strong> ${data.data.name}</p>
                <p><strong>Email:</strong> ${data.data.email}</p>
                <p><strong>Package:</strong> ${data.data.ticket_package}</p>

                <p>
                    <strong>Status:</strong><br>
                    <div class="mb-2">${statusBadges}</div>

                    <button onclick="clearStatus()" class="btn btn-sm btn-outline-danger">
                        <i class="ti ti-trash"></i> Clear Status
                    </button>
                </p>

                <div class="mb-3">
                    <label class="fw-bold mb-2">Select Status:</label>

                    <div id="statusOptions" class="d-flex flex-wrap gap-2">

                        <label class="status-option">
                            <input type="checkbox" value="paid"> Paid
                        </label>

                        <label class="status-option">
                            <input type="checkbox" value="registered"> Registered
                        </label>

                        <label class="status-option">
                            <input type="checkbox" value="attended"> Attended
                        </label>

                        <label class="status-option">
                            <input type="checkbox" value="collected"> Collected
                        </label>

                        <label class="status-option">
                            <input type="checkbox" value="cancelled"> Cancelled
                        </label>

                    </div>
                </div>

                <button onclick="updateStatus()" class="btn btn-success">
                    Update Status
                </button>
            </div>
        `;

        // 2. THEN apply checkbox state (IMPORTANT FIX)
        setTimeout(() => {
            document.querySelectorAll('#statusOptions input').forEach(cb => {
                if (statuses.includes(cb.value)) {
                    cb.checked = true;
                    cb.parentElement.classList.add('active');
                }
            });
        }, 50);
    });
}

// Update status
function updateStatus() {
    const selectedOptions = Array.from(
        document.querySelectorAll('#statusOptions input:checked')
    ).map(cb => cb.value);

    fetch('/dashboard/epd-participants/update-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            participant_id: participant_id,
            status: selectedOptions
        })
    })
    .then(res => res.json())
    .then(data => {

        console.log("Update Response:", data);

        if (data.status === 'success') {
            Swal.fire("Success", "Status updated successfully!", "success");
            fetchParticipant(ticket_code);
                   
        } else {
            Swal.fire("Error", "Failed to update status", "error");
        }
        
    });
}

function clearStatus() {
    Swal.fire({
        title: "Are you sure?",
        text: "This will remove all statuses",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, clear it!"
    }).then((result) => {

        if (!result.isConfirmed) return;

        fetch('/dashboard/epd-participants/clear-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                participant_id: participant_id
            })
        })
        .then(res => res.json())
        .then(data => {

            console.log("Clear Response:", data);

            if (data.status === 'success') {
                Swal.fire("Cleared", "Status reset successfully!", "success");
                fetchParticipant(ticket_code); // refresh UI
            } else {
                Swal.fire("Error", "Failed to clear status", "error");
            }

        });

    });
}

function searchByTicket() {
    const code = document.getElementById('manualTicket').value;

    if (!code) {
        Swal.fire("Error", "Please enter a ticket code", "error");
        return;
    }

    ticket_code = code;
    fetchParticipant(code);
}

let html5QrCode = new Html5Qrcode("reader");
let cameras = [];
let currentCameraIndex = 0;

// Start scanner
function startScanner(cameraId) {
    html5QrCode.start(
        cameraId,
        {
            fps: 10,
            qrbox: 250
        },
        onScanSuccess
    ).catch(err => {
        console.error("Error starting scanner:", err);
    });
}

// Flip camera
document.getElementById('flipCameraBtn').addEventListener('click', () => {
    if (!cameras.length) return;

    // Stop current camera first
    html5QrCode.stop().then(() => {
        // Move to next camera
        currentCameraIndex = (currentCameraIndex + 1) % cameras.length;
        startScanner(cameras[currentCameraIndex].id);
    }).catch(err => console.error("Error stopping scanner:", err));
});

// Init cameras
Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length) {
        cameras = devices;
        startScanner(cameras[currentCameraIndex].id);
    } else {
        alert("No cameras found on this device.");
    }
}).catch(err => console.error("Camera error:", err));

// Scan success callback
function onScanSuccess(decodedText) {
    console.log("QR Data:", decodedText);
    const parts = decodedText.split('/');
    ticket_code = parts[parts.length - 1];
    fetchParticipant(ticket_code);
}

document.addEventListener('click', function(e) {
    if (e.target.closest('.status-option')) {
        let label = e.target.closest('.status-option');
        let checkbox = label.querySelector('input');

        checkbox.checked = !checkbox.checked;
        label.classList.toggle('active', checkbox.checked);
    }
});

</script>

@endsection