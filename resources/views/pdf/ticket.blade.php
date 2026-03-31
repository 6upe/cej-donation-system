<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .ticket { border: 2px solid #000; padding: 20px; width: 400px; text-align: center; }
        .qr { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="ticket">
    <h1>EPD2026 Ticket</h1>
    <p><strong>Name:</strong> {{ $participant->name }}</p>
    <p><strong>Package:</strong> {{ $participant->ticketPackage }}</p>
    <p><strong>Email:</strong> {{ $participant->email }}</p>

    <div class="qr">
        <img src="{{ $qrPath }}" alt="QR Code" style="width: 200px; height: 200px;">
    </div>
</div>
</body>
</html>