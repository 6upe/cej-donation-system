<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Donate' }} - Centre for Environment Justice</title>

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
            overflow-y: scroll;
            overflow-x: hidden;
            background: white;
            padding: 10px;
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
            background: rgba(5, 41, 0, 0.9);
            padding: 15px;
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

        .payment-options {
            height: 35px;
            margin: 0 50px;
        }

        .payment-options img {
            margin: 5px;
            cursor: pointer;
            width: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>
    {{-- <video autoplay loop muted class="video-bg">
        <source src="{{ asset('donate/assets/background-video.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video> --}}

    <div class="container d-flex justify-content-center align-items-center vh-80">

        <div class="container">

            <div class="text-center mb-3 mt-2">
                <img src="{{ asset('donate/assets/cej-logo.png') }}" alt="Logo" style="width: 10%">
                <h1 style="color:rgba(5, 41, 0, 0.9);">Support our Cause</h1>
            </div>

            <div class="row d-flex justify-content-center">
                    <!-- Left Video Section -->
                    <div class="col-lg-6 col-12 p-3 order-lg-2 order-1 ">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <iframe width="100%" height="200"
                                    src="https://www.youtube.com/embed/Nth3lMvbYKM?autoplay=1&mute=1&loop=1&playlist=Nth3lMvbYKM"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <p class="text-dark"><small>Zemba Zemba community struggles for clean water. Help
                                        rehabilitate Musaya Dam.</small></p>

                            </div>
                            <div class="col-md-6 mb-3">
                                <iframe width="100%" height="200"
                                    src="https://www.youtube.com/embed/aUfNbI2MnAo?autoplay=1&mute=1&loop=1&playlist=aUfNbI2MnAo"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                               <p class="text-dark"> <small >Mungulu community endures long queues for unsafe water. Help
                                    build
                                    a water system.</small></p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <iframe width="100%" height="200"
                                    src="https://www.youtube.com/embed/-zYxcyyaTKs?autoplay=1&mute=1&loop=1&playlist=-zYxcyyaTKs"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <p class="text-dark"> <small >Kamuwezhi Primary lacks classrooms & sanitation. Help improve
                                    education facilities.</small></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <iframe width="100%" height="200"
                                    src="https://www.youtube.com/embed/AKJr5KGlmos?autoplay=1&mute=1&loop=1&playlist=AKJr5KGlmos"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <p class="text-dark"> <small >Ngombe Illede community shares a dam with livestock. Support
                                    safe
                                    water access.</small></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <iframe width="100%" height="200"
                                    src="https://www.youtube.com/embed/djNhtVcS1SQ?autoplay=1&mute=1&loop=1&playlist=djNhtVcS1SQ"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                <p class="text-dark"> <small >Families in Serenje suffer from manganese poisoning. Help
                                    advocate for justice.</small></p>
                            </div>

                        </div>
                    </div>

                    <!-- Donation Form Section -->
                    <div class="col-lg-6 col-12 order-lg-1 order-2">
                        <div class="donation-card text-center">
                            {{-- <img src="{{ asset('donate/assets/cej-logo.png') }}" alt="Logo" class="logo">
                            <h3 class="text-light mt-2 mb-2">Make a Donation</h3> --}}
                            <div class="form-container">
                                <form action="{{ route('donations.process') }}" method="POST">
                                    @csrf <!-- CSRF token for security -->

                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="fullname"
                                            placeholder="Full Name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="organization_name"
                                            placeholder="Organization/Company Name">
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email_address"
                                            placeholder="Email Address" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="physical_address"
                                            placeholder="Physical Address">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="donation_type" required>
                                            <option selected disabled value="">Donation Type</option>
                                            <option value="recurring">Recurring</option>
                                            <option value="once">Once Off</option>
                                            <option value="monthly">Monthly</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="donation_currency" required>
                                            <option selected disabled value="">Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="ZMW">ZMW</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-light">Select Amount:</label>
                                        <div class="row">
                                            <div class="col-sm-12 mb-2">
                                                <button type="button" class="btn btn-outline-success amount-btn"
                                                    data-amount="10">10</button>
                                                <button type="button" class="btn btn-outline-success amount-btn"
                                                    data-amount="50">50</button>
                                                <button type="button" class="btn btn-outline-success amount-btn"
                                                    data-amount="100">100</button>
                                                <button type="button" class="btn btn-outline-success"
                                                    id="other-amount-btn">Other</button>
                                            </div>
                                            <div id="other-amount-input" style="display: none;">
                                                <input type="number" class="form-control" name="donation_amount"
                                                    id="donation_amount" placeholder="Enter your amount"
                                                    min="1">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="donation_amount" id="donation_amount_hidden"
                                        value="">

                                    <button type="submit" class="btn btn-success w-100">Donate Now</button>
                                </form>
                            </div>
                        </div>
                    </div>


            </div>

            <div class="text-center mt-1 mb-3 p-2  w-50"
                style="margin: 0 auto; border-radius: 10px; background: rgba(255, 255, 255, 0.877)">
                <div class="w-100">
                    <img src="{{ asset('donate/assets/secure.gif') }}" alt="Secure" style="width: 5%">
                    <h5 class="text-success"> Your donation is secure</h5>
                    <div class="mb-3">
                        <div class="payment-options d-flex justify-content-center">
                            <img src="{{ asset('donate/assets/visa.png') }}" alt="VISA">
                            <img src="{{ asset('donate/assets/mastercard.png') }}" alt="MasterCard">
                            <img src="{{ asset('donate/assets/mtn.png') }}" alt="MTNZM">
                            <img src="{{ asset('donate/assets/airtel.jpg') }}" alt="AirtelZM">
                        </div>
                    </div>
                </div>

            </div>

        </div>



    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const amountButtons = document.querySelectorAll(".amount-btn");
            const otherAmountBtn = document.getElementById("other-amount-btn");
            const otherAmountInput = document.getElementById("other-amount-input");
            const donationAmountHidden = document.getElementById("donation_amount_hidden");
            const donationAmountField = document.getElementById("donation_amount");

            amountButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const amount = this.getAttribute("data-amount");

                    // Set selected amount
                    donationAmountHidden.value = amount;
                    donationAmountField.value = amount;

                    // Highlight selected button
                    amountButtons.forEach(btn => btn.classList.remove("btn-success"));
                    this.classList.add("btn-success");

                    // Hide "Other" input if a predefined amount is selected
                    otherAmountInput.style.display = "none";
                });
            });

            otherAmountBtn.addEventListener("click", function() {
                // Show "Other" amount input
                otherAmountInput.style.display = "block";
                donationAmountField.value = "";
                donationAmountField.focus();

                // Clear previous selection
                amountButtons.forEach(btn => btn.classList.remove("btn-success"));

                // Listen for input change to update hidden field
                donationAmountField.addEventListener("input", function() {
                    donationAmountHidden.value = donationAmountField.value;
                });
            });
        });
    </script>

</body>

</html>
