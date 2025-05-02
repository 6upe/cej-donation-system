<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>{{ $title ?? 'Home' }} - Centre for Environment Justice</title>
  
  <meta name="description" content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
  <meta name="keywords" content="environment, justice, Zambia, sustainability, climate change, conservation">
  <meta name="author" content="Centre for Environment Justice">
  <meta name="robots" content="index, follow">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  

  <!-- Open Graph (Facebook, LinkedIn) -->
  <meta property="og:locale" content="en_US">
  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $title ?? 'Home' }} - Centre for Environment Justice">
  <meta property="og:description" content="Centre for Environment Justice (CEJ) is an outstanding institution with its own unique identity and a proud distinct history in Zambia.">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:site_name" content="Centre for Environment Justice">
  <meta property="og:image" content="{{ asset('assets/images/logos/cej-logo.png') }}">
  <meta property="article:modified_time" content="{{ now()->toIso8601String() }}">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/cej-logo.png') }}">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://cejzambia.org/">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
</head>
