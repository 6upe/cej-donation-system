<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Webhook received', $request->all());

        // Validate the request payload (ensure it’s from a trusted source)
        $request->validate([
            'transaction_token' => 'required|string',
            'status' => 'required|string',
            'transaction_id' => 'nullable|string',
            'company_ref' => 'nullable|string',
        ]);

        // Find the donation record using the transaction token
        $donation = Donation::where('transaction_token', $request->input('transaction_token'))->first();

        if ($donation) {
            // Update donation status based on the response
            $donation->update([
                'status' => $request->input('status'), // Could be "Completed", "Failed", "Pending", etc.
                'transaction_id' => $request->input('transaction_id'),
                'company_ref' => $request->input('company_ref'),
            ]);

            return response()->json(['message' => 'Webhook processed successfully'], 200);
        }

        return response()->json(['error' => 'Donation not found'], 404);
    }
}
