<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;

Route::post('/webhook/transaction-update', [WebhookController::class, 'handle']);

Route::get('/', function () {
    return response()->json(['status' => 'CEJ Payments Api Running...']);
});

Route::post('/create-token', [PaymentController::class, 'createToken']);
Route::post('/charge-token', [PaymentController::class, 'chargeToken']);
Route::post('/verify-token', [PaymentController::class, 'verifyToken']);
Route::post('/verify-all-payments', [PaymentController::class, 'verifyAllPayments']);

Route::get('/epd-participants/{ticket_code}', [PaymentController::class, 'getByTicketCode']);
// Route::post('/resend-ticket', [PaymentController::class, 'resendTicket']);


Route::post('/test-payment-success', [PaymentController::class, 'testPaymentSuccess']);