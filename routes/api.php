<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;
use App\Models\Participant;
use Illuminate\Support\Facades\Log;

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

Route::get('/payments/{id}', function ($id) {
    return \App\Models\Payment::with('participant')->findOrFail($id);
});


Route::post('/test-payment-success', [PaymentController::class, 'testPaymentSuccess']);

Route::get('/fix', function () {

    // abort_unless(app()->environment('local'), 403); // 🔒 only local OR remove after use

    Participant::chunk(100, function ($participants) {

        foreach ($participants as $p) {

            $original = $p->product_status;

            $status = $original;

            // Step 1: decode if string
            if (is_string($status)) {
                $decoded = json_decode($status, true);
                $status = is_array($decoded) ? $decoded : [$status];
            }

            // Step 2: clean + flatten + remove quotes
            $status = collect($status)
                ->flatten()
                ->map(fn($s) => trim($s, '"')) // 🔥 IMPORTANT FIX
                ->filter()
                ->unique()
                ->values()
                ->toArray();

            // Save only if changed
            if ($original != $status) {
                $p->product_status = $status;
                $p->save();

                Log::info('Fixed participant', [
                    'id' => $p->id,
                    'before' => $original,
                    'after' => $status
                ]);
            }
        }
    });

    return response()->json([
        'status' => 'success',
        'message' => 'Product status cleaned successfully'
    ]);
});