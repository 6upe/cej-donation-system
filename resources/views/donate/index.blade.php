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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        .amount-btn {
            color: white;
            border-color: white;
        }
    </style>

</head>

<body>

    

    

    <div class=" w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-3">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logos/cej-logo.png') }}" alt="Logo 1" width="120"
                        class="d-inline-block align-text-top">
                    <p class="fw-bold" style="font-size: medium;"> <small>Our Environment <br> Our Responsibility</small></p>
                </a>

                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logos/dpo-logo.jpg') }}" alt="Logo 2" width="120"
                        class="d-inline-block align-text-top">
                    <p  style="font-size: medium;" class="fw-bold"> <small>Secure Payment Gateway</small>
                    </p>
                </a>
    
            </div>
        </nav>

        <div class="row align-items-center" style="background-color: #006400;">
            <div class="col-md-6 text-white p-4">
                <h3>DONATE NOW TO PROTECT NATURE AND LIVELIHOODS</h3>
                <p> At CEJ, we are dedicated to creating a sustainable future
                    for our communities. Through relentless effort and
                    collaboration with our partners, we strive to promote
                    environmental sustainability, social equity and improve
                    community livelihood. However, achieving our mission is a
                    collective endeavor that requires the support of
                    compassionate individuals like you.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/images/backgrounds/donate 3.jpg') }}" alt="CEJ-Project"
                    class="img-fluid w-100 h-100" style="object-fit: cover;">
            </div>
        </div>
    </div>

    <div class="container my-3">

        <h2 class="text-center mb-4" style="color: #050050">Support Our Cause</h2>
        <hr class="mb-4 text-center" width="30%" style="border: 2px solid #ffd000; margin: 0 auto;">

        <div class="row d-flex justify-content-center bg-white p-4">
            <div class="col-md-6  order-lg-1 order-2 ">
                <div class="row col-12 col-md-12 justify-content-between align-items-center p-3">
                    <div class="col-6 text-center">
                        <iframe class="w-100"
                            src="https://www.youtube.com/embed/ovPlEjw3YIs?si=PNVXJZ8IEjaTAsz2"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <p class="mt-2">Water Security</p>
                    </div>

                    <div class="col-6 text-center">
                        <iframe class="w-100"
                            src="https://www.youtube.com/embed/VFjF8aI692s?si=CswWGGRmzJ2JlYqP"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <p class="mt-2">Environmental Protection</p>
                    </div>

                    <div class="col-6 text-center">
                        <iframe class="w-100"
                            src="https://www.youtube.com/embed/NKUs-YXLcfg?si=OAp2TcJZ43rlbKoH"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <p class="mt-2">Sustainable Energy</p>
                    </div>

                    <div class="col-6 text-center">
                        <iframe class="w-100"
                            src="https://www.youtube.com/embed/hAVUWOa-BaA?si=OFjF0c48e_meWysX"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <p class="mt-2">Agriculture & Livelihood Support</p>
                    </div>

                    <div class="col-6  text-center">
                        <iframe class="w-100"
                            src="https://www.youtube.com/embed/Lp-i-U_PPM0?si=pkccBWwkLKhKhyrN"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <p class="mt-2">Extractive Industries</p>
                    </div>

                    <div class="col-6 text-center">
                        <iframe class="w-100"
                            src="https://www.youtube.com/embed/9IeCysSegjk?si=2Ny13MD4CyZDPtFz"
                            frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                        </iframe>
                        <p class="mt-2">Climate Change</p>
                    </div>



                </div>

                <hr>

                <div>

                    <h2 class="mb-3 text-center" style="color: #050050">Alternative Way to Give</h2>

                    <div class="row col-12 col-md-12">
                        <div class="col-6">
                            <h4 style="color: #050050">By Mail</h4>
                            <p>Centre for Environment Justice Plot No. 100/ZMT 77 HC, Twinpalm Road, IbexHill, Lusaka,
                                Zambia</p>
                        </div>

                        <div class="col-6">
                            <div style="border-left: 2px solid #ffd000;" class="px-3">
                                <h4 style="color: #050050">By Phone</h4>
                                <p>+260 954 713 003</p>
                                <p>Monday - Friday</p>
                                <p>8:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6  order-lg-2 order-1">

                <div class="p-4" style="background-color: #005700; color: white; border-radius: 10px;">
                    <form action="{{ route('donations.process') }}" method="POST">
                        @csrf <!-- CSRF token for security -->

                        <div class="mb-3">
                            <input type="text" class="form-control" name="fullname" placeholder="Full Name">
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
                                        id="donation_amount" placeholder="Enter your amount" min="1">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="donation_amount" id="donation_amount_hidden" value="">

                        <button type="submit" class="btn btn-success w-100">Donate Now</button>
                    </form>
                </div>

                <div class="row">
                    
                    <div style="background: rgb(243, 243, 243); border-radius: 10px;" class="row col-12 my-3">
                        <div class="col-6 mt-3">
                            <div class="d-flex justify-content-around mx-3">
                                <img src="{{ asset('donate/assets/visa.png') }}" alt="Visa Logo" width="60">
                                <img src="{{ asset('donate/assets/mastercard.png') }}" alt="MasterCard Logo"
                                    width="70">
                            </div>
                            <p class="text-center fw-bold mt-2">Credit/Debit Card</p>
                        </div>
    
                        <div class="col-6 mt-3">
                            <div class="d-flex justify-content-around mx-3">
                                <img src="{{ asset('donate/assets/mtn.png') }}" alt="Visa Logo" width="60">
                                <img src="{{ asset('donate/assets/airtel.jpg') }}" alt="MasterCard Logo" width="90">
                            </div>
                            <p class="text-center fw-bold mt-2">Mobile Money</p>
                        </div>
                    </div>
                    
                    <p class="text-center fw-bold">Your Donations Are Safe and Secure with DPO Group</p>
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


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
