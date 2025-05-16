<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-box {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #2C3E50;
        }

        .logo {
            display: block;
            margin: 20px auto;
            max-width: 120px;
        }

        .company-info {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .company-info p {
            margin: 5px 0;
        }

        .invoice-number {
            text-align: right;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .details {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .details p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
            color: #7f8c8d;
        }

        .footer a {
            color: #3498db;
            text-decoration: none;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="invoice-box">
        <div class="header">
            
            <img class="logo" src="{{ public_path('assets/images/logos/cej-logo.png') }}" width="60px" alt="CEJ Logo">

            <div class="company-info">
                <p><strong>Centre for Environment Justice (CEJ)</strong></p>
                <p>Plot No. 100/ZMT 77 HC, Twinpalm Road, IbexHill, Lusaka, Zambia</p>
                <p>Email: <a href="mailto:centreforenvironmentjustice@gmail.com">centreforenvironmentjustice@gmail.com</a></p>
                <p>Info: <a href="mailto:Info@cejzambia.org">Info@cejzambia.org</a></p>
                <p>Phone: +260 954 710003 | +260 977 256172 | +260 966 603537</p>
            </div>
        </div>

        <div class="invoice-number">
            <p><strong>Invoice No:</strong> #{{ $donation->id }}</p>
            <p><strong>Date:</strong> {{ $donation->created_at }}</p>
        </div>

        <table class="details" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Donor Name:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->donor->first_name }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>Donor Name:</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->donor->organization_name }}</td>
                </tr>
            <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Email:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->donor->email }}</td>
            </tr>
            <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Amount:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->donation_amount }} {{ $donation->donation_currency }}</td>
            </tr>
            <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Transaction ID:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->transaction_id }}</td>
            </tr>
            <!-- <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Approval Code:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->ccd_approval }}</td>
            </tr> -->
            <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Company Reference:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->company_ref }}</td>
            </tr>
            <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><strong>Status:</strong></td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $donation->status }}</td>
            </tr>
        </table>

        <p style="text-align: center; margin-top: 20px; font-size: 18px; font-weight: bold;">Thank you for your generosity!</p>
        
        <div class="footer">
            <p>&copy; 2025 Centre for Environment Justice. All rights reserved.</p>
            <p>For more information, visit <a href="https://cejzambia.org">cejzambia.org</a></p>
        </div>
    </div>

</body>
</html>
