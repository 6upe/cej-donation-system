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
            max-width: 100vw;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .form-container {
            flex: 1;
            padding-right: 10px;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 100px;
        }

        .payment-options {
            height: 55px;
            margin: 0 50px;
        }

        .payment-options img {
            margin: 5px;
            cursor: pointer;
            width: 100%;
            object-fit: contain;
        }

        #payment-form-container {
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <video autoplay loop muted class="video-bg">
        <source src="background-video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-12">
            <div class="donation-card">
                <img src="assets/cej-logo.png" alt="Logo" class="logo">

                <div class="form-container">
                    <div class="row">

                        <div class="col-lg-6 mb-3">
                            <div class="w-100 text-center mb-2">
                                <label class="lead">Select Payment Method</label>
                                @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            

                            </div>
                            <form id="checkout-form" action="{{ route('donations.checkoutPayment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" id="payment_method">
                                <input type="hidden" name="transaction_token" value="{{ $transaction_token }}">
                                <input type="hidden" name="transaction_token" value="{{ $transaction_token }}">

                                <div class="mb-3">
                                    <div class="payment-options d-flex justify-content-center">
                                        <img src="assets/visa.png" alt="VISA" class="payment-option-img">
                                        <img src="assets/mastercard.png" alt="MasterCard" class="payment-option-img">
                                        <img src="assets/mtn.png" alt="MTNZM" class="payment-option-img">
                                        <img src="assets/airtel.jpg" alt="AirtelZM" class="payment-option-img">
                                    </div>
                                </div>
                                <style>
                                    .payment-option-img {
                                        transition: box-shadow 0.2s, transform 0.2s;
                                        border-radius: 8px;
                                    }
                                    .payment-option-img:hover, .payment-option-img:focus {
                                        box-shadow: 0 4px 16px rgba(0,0,0,0.25), 0 0 0 2px #198754;
                                        transform: translateY(-2px) scale(1.05);
                                        z-index: 1;
                                    }
                                    .payment-option-img {
                                        outline: none;
                                    }
                                </style>

                                <div id="payment-form-container" class="w-75"></div>

                                <script>
                                    document.getElementById("checkout-form").addEventListener("submit", function(event) {
                                        const paymentMethod = document.getElementById("payment_method").value;
                                        if (!paymentMethod) {
                                            event.preventDefault();
                                            alert("Please select a payment method before proceeding.");
                                        }

                                        if (paymentMethod === 'VISA' || paymentMethod === 'MasterCard') {
                                            const cardNumber = document.querySelector('input[name="card_number"]').value;
                                            const expiryDate = document.querySelector('input[name="expiry_date"]').value;
                                            const cvv = document.querySelector('input[name="cvv"]').value;

                                            if (!cardNumber || !expiryDate || !cvv) {
                                                event.preventDefault();
                                                alert("Please fill in all card details before proceeding.");
                                            }
                                        } else if (paymentMethod === 'MTNZM' || paymentMethod === 'AIRTELZM') {
                                            const phoneNumber = document.querySelector('input[name="phone_number"]').value;

                                            if (!phoneNumber) {
                                                event.preventDefault();
                                                alert("Please fill in your phone number before proceeding.");
                                            }
                                        }

                                        Swal.fire({
                                            title: 'Processing Payment',
                                            text: 'Please wait while we process your payment...',
                                            icon: 'info',
                                            allowOutsideClick: false,
                                            showConfirmButton: false,
                                            onBeforeOpen: () => {
                                                Swal.showLoading();
                                            }
                                        });

                                    });


                                    document.querySelectorAll('.payment-options img').forEach(img => {
                                        img.addEventListener('click', function() {
                                            document.getElementById('payment_method').value = this.alt; // Store selected method

                                            const paymentFormContainer = document.getElementById('payment-form-container');
                                            paymentFormContainer.innerHTML = '';

                                            if (this.alt === 'VISA' || this.alt === 'MasterCard') {
                                                // paymentFormContainer.innerHTML = `
                                                //     <div class="mb-3">
                                                //         <label for="cardNumber" class="form-label">${this.alt} Card Number</label>
                                                //         <input type="text" class="form-control" name="card_number" placeholder="Enter card number">
                                                //     </div>
                                                //     <div class="row">
                                                //         <div class="col-md-6 mb-3">
                                                //             <label for="expiryDate" class="form-label">Expiry Date</label>
                                                //             <input type="text" class="form-control" name="expiry_date" placeholder="MM/YY">
                                                //         </div>
                                                //         <div class="col-md-6 mb-3">
                                                //             <label for="cvv" class="form-label">CVV</label>
                                                //             <input type="text" class="form-control" name="cvv" placeholder="Enter CVV">
                                                //         </div>
                                                //     </div>
                                                // `;

                                                Swal.fire({
                                                    title: 'Redirecting...',
                                                    text: 'Please wait while we redirect you to the secure payment gateway...',
                                                    icon: 'info',
                                                    allowOutsideClick: false,
                                                    showConfirmButton: false,
                                                    onBeforeOpen: () => {
                                                        Swal.showLoading();
                                                    }
                                                });

                                                setTimeout(() => {
                                                    // Simulate form submission after a delay
                                                    document.getElementById('checkout-form').submit();
                                                }, 2000);

                                            } else if (this.alt === 'MTNZM' || this.alt === 'AirtelZM') {
                                                paymentFormContainer.innerHTML = `
                                                    <div class="mb-3">
                                                        <label for="phoneNumber" class="form-label">${this.alt} Phone Number</label>
                                                        <input type="text" class="form-control" name="phone_number" placeholder="260912345678" required>
                                                    </div>
                                                `;
                                            }
                                        });
                                    });
                                </script>

                                <div class="w-100 text-center">
                                    <button type="submit" class="btn btn-success w-75">Complete Payment</button>
                                </div>
                            </form>

                        </div>

                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="text-center">
                                        <th scope="row" colspan="2">Donation Summary</th>
                                    </tr>
                                    <tr>
                                        <th scope="row">Donor Name</th>
                                        <td>{{ $donor->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $donor->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{ $donor->address }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Organization</th>
                                        <td>{{ $donor->organization_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Donation Type</th>
                                        <td>{{ $donation->donation_type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Amount</th>
                                        <td>{{ $donation->donation_amount }} {{ $donation->donation_currency }}</td>
                                    </tr>



                                    <tr>
                                        <th scope="row">Transaction Token</th>
                                        <td>{{ $transaction_token }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
