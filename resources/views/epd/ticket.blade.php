<div style="max-width:600px;margin:auto;padding:20px;font-family:sans-serif;">

    <h2>🎟 Ticket Verification</h2>

    <div style="border:1px solid #ddd;padding:20px;border-radius:8px;">
        <p><strong>Name:</strong> {{ $participant->name }}</p>
        <p><strong>Email:</strong> {{ $participant->email }}</p>
        <p><strong>Package:</strong> {{ $participant->ticketPackage }}</p>
        <p><strong>Status:</strong> 
            <span style="color:green">{{ $participant->status ?? 'registered' }}</span>
        </p>
    </div>

    <form method="POST" action="/ticket/{{ $participant->ticket_code }}/update-status" style="margin-top:20px;">
        @csrf

        <select name="status" style="padding:10px;width:100%;">
            <option value="registered">Registered</option>
            <option value="attended">Attended</option>
            <option value="collected">Collected</option>
            <option value="cancelled">Cancelled</option>
        </select>

        <button style="margin-top:10px;padding:10px;width:100%;background:black;color:white;border:none;">
            Update Status
        </button>
    </form>

</div>