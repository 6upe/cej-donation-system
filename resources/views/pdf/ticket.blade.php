<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>EPD2026 Receipt</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo img {
            height: 60px;
        }

        .company {
            text-align: right;
            font-size: 11px;
        }

        .title {
            margin-top: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        /* INFO SECTIONS */
        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px 0;
        }

        .label {
            color: #777;
            width: 40%;
        }

        .value {
            font-weight: bold;
        }

        /* PAYMENT BOX */
        .payment-box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
        }

        /* FOOTER */
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #888;
        }

        /* QR */
        .qr-container {
            text-align: right;
        }

        .qr-container img {
            width: 120px;
            height: 120px;
        }

        .grid {
            width: 100%;
        }

        .grid td {
            vertical-align: top;
        }

    </style>
</head>

<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <img src="{{ public_path('assets/images/logos/cej-logo.png') }}" alt="EPD2026 Logo">
        </div>

        <div class="company">
            
        <img src="{{ public_path('assets/images/logos/epd.jpeg') }}" alt="epd Banner" style="width: 100px; margin-bottom: 10px;">

            <strong>Environmental Protection Dialogue - EPD2026</strong><br>
            Plot No. 37741, Pitta Road, Off Twin Palm Road, Ibex Hill, Lusaka – Zambia <br>
            epd@cejzambia.org / programmes@cejzambia.org <br>
            +260 966 762215 / +260 971 479976 / +260 977 123413<br>
        </div>
    </div>

    <div class="title">Payment Receipt & Ticket</div>

    <!-- RECEIPT DETAILS -->
    <div class="section">
        <table>
            <tr>
                <td class="label">Ticket Code:</td>
                <td class="value">{{ $participant->ticket_code }}</td>
                <td class="label">Ticket status:</td>
                <td class="value">{{ $participant->product_status }}</td>
            </tr>
            <tr>
                <td class="label">Date:</td>
                <td class="value">{{ date('d M Y') }}{{ date(' H:i:s') }}</td>
                <td class="label">Payment Status:</td>
                <td class="value">{{ $participant->payment_status }}</td>
            </tr>
        </table>
    </div>

    <!-- GRID: DETAILS + QR -->
    <table class="grid">
        <tr>
            <!-- LEFT SIDE -->
            <td style="width: 65%; padding-right: 20px;">

                <!-- PARTICIPANT -->
                <div class="section">
                    <div class="section-title">Participant Information</div>
                    <table>
                        <tr>
                            <td class="label">Full Name:</td>
                            <td class="value">{{ $participant->name }}</td>
                        </tr>
                        <tr>
                            <td class="label">Email:</td>
                            <td class="value">{{ $participant->email }}</td>
                        </tr>
                        <tr>
                            <td class="label">Phone:</td>
                            <td class="value">{{ $participant->phone }}</td>
                        </tr>
                        <tr>
                            <td class="label">Organisation:</td>
                            <td class="value">{{ $participant->organisation }}</td>
                        </tr>
                        <tr>
                            <td class="label">Designation:</td>
                            <td class="value">{{ $participant->jobTitle }}</td>
                        </tr>
                    </table>
                </div>

                <!-- PAYMENT -->
                <div class="section">
                    <div class="section-title">Payment Details</div>

                    <div class="payment-box">
                        <table>
                            <tr>
                                <td class="label">Package:</td>
                                <td class="value">{{ $participant->ticket_package }}</td>
                            </tr>
                            <tr>
                                <td class="label">Category:</td>
                                <td class="value">{{ $participant->delegate_category }}</td>
                            </tr>
                            <tr>
                                <td class="label">Amount Paid:</td>
                                <td class="value">ZMW {{ number_format($participant->amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="label">Payment Method:</td>
                                <td class="value">Mobile / Card</td>
                            </tr>
                        </table>
                    </div>
                </div>

            </td>

            <!-- RIGHT SIDE QR -->
            <td class="qr-container">
                <img src="{{ $qrPath }}" alt="QR Code">
                <p style="font-size:10px; margin-top:5px;">
                    Scan to verify ticket
                </p>
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        This is a system-generated receipt. For support, contact support@epd2026.org
    </div>

</div>
</body>
</html>