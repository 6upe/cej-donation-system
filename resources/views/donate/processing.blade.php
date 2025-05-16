<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Home' }} - Centre for Environment Justice</title>
    <meta name="description" content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
    <meta name="keywords" content="environment, justice, Zambia, sustainability, climate change, conservation">
    <meta name="author" content="Centre for Environment Justice">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/cej-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f2f2f2; /* Light gray background */
        }

        .donation-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); /* More pronounced shadow */
            margin-top: 120px;
            width: 100%;
            max-width: 700px; /* Narrow width */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo {
            display: block;
            margin: 0 auto 20px auto;
            max-width: 80px;
        }

        .btn-cej {
            background-color: #006400;
            color: white;
            border: none;
            margin: 5px;
        }

        .btn-cej:hover {
            background-color: #004d00;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-80">
        <div class="donation-card text-center">
            <img src="assets/cej-logo.png" alt="Logo" class="logo">

            @if (isset($instruction))
                <p>{{ $instruction }}</p>
            @endif

            <div class="mt-4">
                <a href="https://donate.cejzambia.org" class="btn btn-cej">Donate Again</a>
                <a href="https://cejzambia.org" class="btn btn-cej">Home</a>
                <a href="javascript:location.reload();" class="btn btn-cej">Send prompt Again</a>
                <a href="javascript:location.reload();" class="btn btn-cej">Done</a>
            </div>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        document.getElementById('transID')?.innerText = urlParams.get('TransID') || 'N/A';
        document.getElementById('ccdApproval')?.innerText = urlParams.get('CCDapproval') || 'N/A';
        document.getElementById('companyRef')?.innerText = urlParams.get('CompanyRef') || 'N/A';
    </script>
</body>

</html>
