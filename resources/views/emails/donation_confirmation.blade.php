<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Donation Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #333333;
            text-align: center;
        }
        p {
            font-size: 16px;
            color: #555555;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888888;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo">
            <img src="{{ public_path('donate/assets/cej-logo.png') }}" width="60px" alt="cej logo">
        </div>

        <!-- Header -->
        <h1>Donation Confirmation</h1>

        <!-- Thank You Message -->
        <p>Dear {{ $donation->fullname }},</p>
        <p>We are deeply grateful for your generous donation which we have successfully received. Your contribution has a meaningful impact in the lives of those we serve. With your support, we can drive sustainable solutions to address pressing environmental issues and strengthen community resilience.</p>
        <p>Your generosity is instrumental in advancing the work of the <strong>Centre for Environment Justice (CEJ)</strong> as we continue to protect our environment and empower communities across Zambia.</p>
        
         <!-- Donation Details Table -->
         <table>
            <tr>
                <th>Transaction ID</th>
                <td>{{ $donation->transaction_id }}</td>
            </tr>
            <tr>
                <th>Approval Code</th>
                <td>{{ $donation->ccd_approval }}</td>
            </tr>
            <tr>
                <th>Company Reference</th>
                <td>{{ $donation->company_ref }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $donation->created_at->format('F d, Y') }}</td>
            </tr>
        </table>
        
        <p>Thank you for supporting CEJ’s mission to improve the lives of the communities we serve.</p>
        <p>Please find attached a receipt for your records.</p>
        <p>With utmost sincerity,<br><strong style="color:#367530;">CEJ</strong></p>
        <div class="cta">
            <a href="https://cejzambia.org/">Visit Our Website</a>
        </div>

       

        <!-- Closing Message -->
        

        <div style="text-align: center; font-size: 12px; color: #888888;">
            Powered By <a href="https://pikozm.com" style="color: #007bff;">Piko Tech Services</a>
        </div>
    </div>
</body>
</html>
