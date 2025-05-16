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

  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $title ?? 'Home' }} - Centre for Environment Justice">
  <meta property="og:description" content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="Centre for Environment Justice">
  <meta property="og:image" content="{{ asset('assets/images/logos/cej-logo.png') }}">
  <meta property="article:modified_time" content="{{ now()->toIso8601String() }}">

  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/cej-logo.png') }}">
  <link rel="canonical" href="https://cejzambia.org/">
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
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
      height: 600px;
      width: 100%;
      max-width: 400px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .logo {
      display: block;
      margin: 0 auto 20px auto;
      max-width: 60px;
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

    .transaction-details p {
      font-size: 0.95rem;
      margin-top: 15px;
    }
  </style>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="donation-card text-center">
      <img src="assets/cej-logo.png" alt="Logo" class="logo">
      <h3 class="text-success mt-2 mb-3">Donation Successful!</h3>

      <img src="https://miro.medium.com/v2/resize:fit:1400/1*Tt1d7z553M0-vKfo0N9Krw.gif" width="50%" alt="Success GIF">

      <div class="transaction-details mt-3">
        <p><strong>Note:</strong> An invoice has been sent to your email. (Kindly also Check your SPAM folder)</p>
      </div>

      <div class="mt-4">
        <a href="https://donate.cejzambia.org" class="btn btn-cej">Donate Again</a>
        <a href="https://cejzambia.org" class="btn btn-cej">Home</a>
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
