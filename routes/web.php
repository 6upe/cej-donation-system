<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;



use App\Http\Controllers\AuthController;

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

    Route::get('forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'reset'])->name('password.update');

});


// Dashboard Routes
Route::prefix('dashboard')->middleware('auth')->group(function () {
    // Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/home', [DashboardController::class, 'home'])->name('dashboard.home');
    Route::get('/donations', [DashboardController::class, 'donations'])->name('dashboard.donations');
    Route::get('/donations/{id}/invoice', [DonationController::class, 'generateInvoice'])->name('donations.invoice');
    Route::get('/donors', [DashboardController::class, 'donors'])->name('dashboard.donors');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('dashboard.reports');
    Route::get('/help', [DashboardController::class, 'help'])->name('dashboard.help');

    Route::get('/payments', [DashboardController::class, 'payments'])->name('dashboard.epdPayments');


    Route::get('/epd-participants', [DashboardController::class, 'epdParticipants'])->name('dashboard.epdParticipants');
    Route::get('/epd-participants/search', [DashboardController::class, 'search'])->name('dashboard.epdParticipants.search');
    Route::post('/epd-participants/update-status', [DashboardController::class, 'updateStatusAjax'])->name('dashboard.epdParticipants.updateStatus');
    Route::post('/epd-participants/clear-status', [DashboardController::class, 'clearStatusAjax'])->name('dashboard.epdParticipants.clearStatus');
    Route::post('/resend-ticket', [PaymentController::class, 'resendTicket']);

    
    
    Route::get('/epd-participants/scanner', function () {
        $userFirstName = auth()->user()->first_name;
        return view('dashboard.sections.scanner', [
            'title' => 'EPD Participants Scanner',
            'userFirstName' => $userFirstName
        ]);
    })->name('dashboard.scanner');

});





Route::get('/', [DonationController::class, 'showForm'])->name('donate.form');

Route::prefix('donate')->group(function () {
    Route::post('/process', [DonationController::class, 'processDonation'])->name('donations.process');
    Route::post('/checkout', [DonationController::class, 'checkoutDonation'])->name('donations.checkout');
    Route::post('/checkout-payment', [DonationController::class, 'checkoutDonationPayment'])->name('donations.checkoutPayment');
    Route::get('/success', [DonationController::class, 'success'])->name('donate.success');
    Route::get('/failure', [DonationController::class, 'failure'])->name('donate.failure');
});

Route::get('/ticket/{code}', [PaymentController::class, 'show'])->name('ticket.show');
// Route::post('/ticket/{code}/update-status', [PaymentController::class, 'updateStatus']);

Route::get('/test', function () {
    $mno = "MTNZM";
    $phone = "260962893773";
    $amount = "1";
    $country = "zambia";
    $PaymentCurrency = "ZMW";

    $response = chargeTokenMobileMoney($mno, $phone, $amount, $country, $PaymentCurrency);

    return response()->json($response);
});

function chargeTokenMobileMoney($mno, $phone, $amount, $country, $PaymentCurrency)
{
    $endpoint_url = "https://secure.3gdirectpay.com/API/v6/";
    $CompanyToken = "8D3DA73D-9D7F-4E09-96D4-3D44E7A83EA3";

    // Call the method from DonationController correctly
    $transToken = CreateChargeToken(
        "https://webhook.site/54e2e771-bbc5-4818-bc1a-b0920dd1d797",
        "https://webhook.site/54e2e771-bbc5-4818-bc1a-b0920dd1d797",
        "Pay product",
        $amount,
        $PaymentCurrency
    );

    if ($transToken['response']->Result == 000) {
        $xmlData = '<?xml version="1.0" encoding="UTF-8"?> 
            <API3G> 
                <CompanyToken>' . $CompanyToken . '</CompanyToken> 
                <Request>ChargeTokenMobile</Request> 
                <TransactionToken>' . $transToken['response']->TransToken . '</TransactionToken> 
                <PhoneNumber>' . $phone . '</PhoneNumber> 
                <MNO>' . $mno . '</MNO> 
                <MNOcountry>' . $country . '</MNOcountry> 
            </API3G>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

        $result = curl_exec($ch);

        if ($result === false) {
            return ["error" => "cURL execution failed: " . curl_error($ch)];
        }

        curl_close($ch);

        return [
            "result" => $result,
            "token" => $transToken['response']->TransToken,
            "isSuccess" => strpos($result, '130') !== false
        ];
    } else {
        return ["error" => $transToken["message"]];
    }
}

function CreateChargeToken($RedirectURL, $BackURL, $ServiceDescription, $PaymentAmount, $PaymentCurrency)
{

    $ServiceDate = date('Y-m-d H:i:s');
    $endpoint = "https://secure.3gdirectpay.com/API/v6/";
    $CompanyToken = "8D3DA73D-9D7F-4E09-96D4-3D44E7A83EA3";

    $xmlData = "<?xml version=\"1.0\" encoding=\"utf-8\"?><API3G><CompanyToken>" . $CompanyToken . "</CompanyToken><Request>createToken</Request><Transaction><PaymentAmount>" . $PaymentAmount . "</PaymentAmount><PaymentCurrency>" . $PaymentCurrency . "</PaymentCurrency><CompanyRef>" . DonationController::$ref . "</CompanyRef><RedirectURL>" . $RedirectURL . "</RedirectURL><BackURL>" . $BackURL . "</BackURL><CompanyRefUnique>0</CompanyRefUnique><PTL>5</PTL></Transaction><Services><Service><ServiceType>5525</ServiceType><ServiceDescription>" . $ServiceDescription . "</ServiceDescription><ServiceDate>" . $ServiceDate . "</ServiceDate></Service></Services></API3G>";

    $ch = curl_init();

    if (!$ch) {
        die("Couldn't initialize a cURL handle");
    }
    
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

    $result = curl_exec($ch);


    curl_close($ch);

    // Parse the XML response using SimpleXML 
    $response = simplexml_load_string($result);
    return ["message" => $result, "response" => $response];
}


// Logout Route
Route::get('/auth/logout', function () {
    auth()->logout();
    return redirect('/auth/login')->with('status', 'Logged out successfully.');
})->name('auth.logout');
