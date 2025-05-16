<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Donation Failed' }} - Centre for Environment Justice</title>

    <meta name="description" content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
    <meta name="keywords" content="environment, justice, Zambia, sustainability, climate change, conservation">
    <meta name="author" content="Centre for Environment Justice">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="Donation Failed - Centre for Environment Justice">
    <meta property="og:description" content="Unfortunately, your donation did not go through. Please try again.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Centre for Environment Justice">
    <meta property="og:image" content="{{ asset('assets/images/logos/cej-logo.png') }}">
    <meta property="article:modified_time" content="{{ now()->toIso8601String() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/cej-logo.png') }}">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f1f1f1;
        }

        .donation-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            display: block;
            margin: 0 auto 15px;
            max-width: 60px;
        }

        .btn-cej-green {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-cej-green:hover {
            background-color: #218838;
        }

        .btn-space {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="donation-card">
                <img src="{{ asset('assets/cej-logo.png') }}" alt="Logo" class="logo">
                <h3 class="text-danger mb-3">Donation Failed</h3>

                <img src="https://media.lordicon.com/icons/wired/flat/38-error-cross-simple.gif" width="50%" alt="Failure Icon">

                <p class="mt-4">Unfortunately, we were unable to process your donation.</p>
                <p>Please try again or contact us for assistance.</p>

                <div class="mt-4">
                    <a href="https://donate.cejzambia.org" class="btn btn-cej-green btn-space">Try Again</a>
                    <a href="https://cejzambia.org" class="btn btn-secondary btn-space">Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
