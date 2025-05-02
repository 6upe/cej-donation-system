<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Home' }} - Centre for Environment Justice</title>

    <meta name="description"
        content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
    <meta name="keywords" content="environment, justice, Zambia, sustainability, climate change, conservation">
    <meta name="author" content="Centre for Environment Justice">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'Home' }} - Centre for Environment Justice">
    <meta property="og:description"
        content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Centre for Environment Justice">
    <meta property="og:image" content="{{ asset('assets/images/logos/cej-logo.png') }}">
    <meta property="article:modified_time" content="{{ now()->toIso8601String() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/cej-logo.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://cejzambia.org/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .donation-card {
            background: rgb(255, 255, 255);
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .form-container {
            flex: 1;
            /* overflow-y: auto; */
            /* padding-right: 10px; */
        }

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 50px;
        }

        .amount-btn {
            color: white;
            border-color: white;
        }
    </style>
</head>

<body>
    <video autoplay loop muted class="video-bg">
        <source src="assets/background-video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-6">
            <div class="donation-card text-center">
                <img src="assets/cej-logo.png" alt="Logo" class="logo">
               
                @if (isset($message))
                    <p>{{ $message }}</p>
                @endif

                @if (isset($instruction))
                    <p>{{ $instruction }}</p>
                @endif


                <div class="mt-4">
                    <a href="https://donate.cejzambia.org" class="btn btn-primary">Donate Again</a>
                    <a href="https://cejzambia.org" class="btn btn-secondary">Home</a>
                    <a href="javascript:location.reload();" class="btn btn-warning">Send prompt Again</a>
                    <a href="javascript:location.reload();" class="btn btn-success">Done</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get query parameters from URL
        const urlParams = new URLSearchParams(window.location.search);

        document.getElementById('transID').innerText = urlParams.get('TransID') || 'N/A';
        document.getElementById('ccdApproval').innerText = urlParams.get('CCDapproval') || 'N/A';
        document.getElementById('companyRef').innerText = urlParams.get('CompanyRef') || 'N/A';
    </script>
</body>

</html>
