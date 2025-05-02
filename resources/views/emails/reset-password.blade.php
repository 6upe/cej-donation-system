<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 40px;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header img {
            width: 120px;
            margin-bottom: 20px;
        }
        .email-content h1 {
            color: #333;
            font-size: 22px;
            margin-bottom: 10px;
        }
        .email-content p {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
        .button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-size: 16px;
        }
        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <img src="{{ asset('assets/images/logos/cej-logo.png') }}" alt="CEJ - Donation System Logo">
        </div>

        <div class="email-content">
            <h1>Password Reset Request</h1>
            <p>We received a request to reset your password. Click the button below to proceed.</p>
            <a href="{{ $actionUrl }}" class="button">Reset Your Password</a>
            <p>If you didn’t request this, you can safely ignore this email.</p>
        </div>

        <div class="footer">
            <p>Thanks,<br><strong>{{ config('app.name') }}</strong></p>
        </div>
    </div>

</body>
</html>
