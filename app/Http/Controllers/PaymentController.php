<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Date;
use App\Models\Participant;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $companyToken;
    private $baseUrl;

    public function __construct()
    {
        $this->companyToken = env('DPO_COMPANY_TOKEN');
        $this->serviceType = env('DPO_SERVICE_TYPE');
        // $this->companyToken = 'B3F59BE7-0756-420E-BB88-1D98E7A6B040';
        // $this->serviceType = '54841'; // Example service type
        $this->baseUrl = "https://secure.3gdirectpay.com/API/v6/";
    }

    /**
     * STEP 1: Create Token (Initialize Payment)
     */
    public function createToken(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'product' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'currency' => 'required|string',
            'ticketPackage' => 'required|string',
            'delegateCategory' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'organisation' => 'required|string',
            'jobTitle' => 'required|string',
            'referral' => 'required|string'
        ]);

        

        log::info('Create Token Request', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'product' => $request->product,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'ticketPackage' => $request->ticketPackage,
            'delegateCategory' => $request->delegateCategory,
            'province' => $request->province,
            'district' => $request->district,
            'organisation' => $request->organisation,
            'jobTitle' => $request->jobTitle,
            'referral' => $request->referral
        ]);

        // return ;

        $companyRef = uniqid('EPD' . date('Y') . 'TXN');
        $serviceDate = $request->service_date ?? date('Y/m/d H:i');

        
        $xml = "
        
        <?xml version=\"1.0\" encoding=\"utf-8\"?>
            <API3G>
            <CompanyToken>" . $this->companyToken . "</CompanyToken>
            <Request>createToken</Request>

            <Transaction>
                <PaymentAmount>" . $request->amount . "</PaymentAmount>
                <PaymentCurrency>" . $request->currency . "</PaymentCurrency>
                <CompanyRef>" . $companyRef . "</CompanyRef>

                <RedirectURL>".$_ENV['FRONTEND_URL']."/success</RedirectURL>
                <BackURL>".$_ENV['FRONTEND_URL']."/failure</BackURL>

                <CompanyRefUnique>0</CompanyRefUnique>
                <PTL>5</PTL>

                <customerFirstName>" . $request->name . "</customerFirstName>
                <customerLastName>" . $request->name . "</customerLastName>
                <customerEmail>" . $request->email . "</customerEmail>
            </Transaction>

            <Services>
                <Service>
                <ServiceType>" . $this->serviceType . "</ServiceType>
                <ServiceDescription>" . $request->product . "</ServiceDescription>
                <ServiceDate>" . $serviceDate . "</ServiceDate>
                </Service>
            </Services>
            </API3G>
        ";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/xml',
                'Accept' => 'application/xml'
            ])->send('POST', $this->baseUrl, [
                'body' => $xml
            ]);

            $body = simplexml_load_string($response->body());

            if (isset($body->TransToken)) {

                // Save participant first
                $participant = Participant::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'product' => $request->product,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'ticket_package' => $request->ticketPackage,
                    'delegate_category' => $request->delegateCategory,
                    'province' => $request->province,
                    'district' => $request->district,
                    'organisation' => $request->organisation,
                    'job_title' => $request->jobTitle,
                    'referral' => $request->referral,
                    'transaction_token' => (string)$body->TransToken,
                    'payment_status' => 'pending',
                    'product_status' => ['initial'],
                    'ticket_code' => 'Not Generated'
                ]);

                Payment::create([
                    'participant_id' => $participant->id,
                    'transaction_token' => (string)$body->TransToken,
                    'transaction_ref' => $companyRef,
                    'amount' => $request->amount,
                    'currency' => $request->currency,
                    'payment_method' => 'null',
                    'status' => 'pending',
                    'raw_response' => json_decode(json_encode($body), true),
                ]);

                return response()->json([
                    'status' => 'success',
                    'token' => (string)$body->TransToken,
                    'ref' => $companyRef
                ]);
            }

            Log::error('DPO Token Error', ['response' => $response->body()]);

            return response()->json([
                'status' => 'error',
                'message' => $response->body()
            ], 500);

        } catch (\Exception $e) {
            Log::error('Create Token Exception', ['error' => $e->getMessage()]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * STEP 2: Charge Token (Execute Payment)
     */
    public function chargeToken(Request $request)
    {
        // $request->validate([
        //     'token' => 'required|string',
        //     'method' => 'required|in:card,mobile',
        //     'mobile_number' => 'required_if:method,mobile|string',
        //     'MNO' => 'required_if:method,mobile|string',
        //     'country' => 'required_if:method,mobile|string',
        // ]);

        $token = $request->token;
        $method = $request->method;
        $mobileNumber = $request->mobileNumber;
        $MNO = $request->MNO;
        $country = $request->country;

        $payment = Payment::where('transaction_token', $token)->first();
    
        log::info('Charge Token Request', [
            'token' => $token,
            'method' => $method,
            'mobile_number' => $mobileNumber
        ]);

        // CARD PAYMENT → Redirect to DPO Hosted Page
        if ($method === 'card') {

             if ($payment) {
                $payment->update([
                    'payment_method' => 'card',
                    'status' => 'pending'
                ]);
            }


            return response()->json([
                'status' => 'redirect',
                'payment_url' => "https://secure.3gdirectpay.com/payv2.php?ID={$token}"
            ]);
        }

        // MOBILE MONEY (PLACEHOLDER)
        // Replace with Flutterwave / Cellulant API
        if (in_array($method, ['mobile'])) {

            // Example log (for now)
            Log::info("Mobile Money Request", [
                'token' => $token,
                'method' => $method,
                'mobile_number' => $mobileNumber,
                'MNO' => $MNO,
                'country' => $country
            ]);

            $xmlChargeTokenMobile = "
                <?xml version=\"1.0\" encoding=\"UTF-8\"?>
                    <API3G>
                    <CompanyToken>" . $this->companyToken . "</CompanyToken>
                    <Request>ChargeTokenMobile</Request>
                    <TransactionToken>" . $token . "</TransactionToken>
                    <PhoneNumber>".$mobileNumber."</PhoneNumber>
                    <MNO>".$MNO."</MNO>
                    <MNOcountry>".$country."</MNOcountry>
                    </API3G>
            ";

            Log::info('XML being sent to DPO', ['xml' => $xmlChargeTokenMobile]);

            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/xml',
                    'Accept' => 'application/xml'
                ])->send('POST', $this->baseUrl, [
                    'body' => $xmlChargeTokenMobile
                ]);


                $xmlString = $response->body();

                // replace common invalid characters
                $xmlString = str_replace('&', '&amp;', $xmlString);

                $body = simplexml_load_string($xmlString);

                Log::info('DPO Response', [
                    'raw' => $response->body()
                ]);

                $statusCode = (string) ($body->StatusCode ?? $body->Result ?? null);
                $message = (string) ($body->ResultExplanation ?? 'No message');
                $instructions = html_entity_decode((string) ($body->instructions ?? ''));

                $payment->update([
                    'payment_method' => 'mobile',
                    'mno' => $MNO,
                    'mno_country' => $country,
                    'status' => $statusCode == '130' ? 'pending' : 'failed',
                    'response_message' => $message,
                    'raw_response' => json_decode(json_encode($body), true),
                ]);

                // Log parsed response
                Log::info('Parsed DPO Response', [
                    'statusCode' => $statusCode,
                    'message' => $message,
                    'instructions' => $instructions
                ]);

                // ✅ 130 → Payment initiated (MOST IMPORTANT CASE)
                if ($statusCode == '130') {

                    return response()->json([
                        'status' => 'pending',
                        'message' => 'Payment request sent. Check your phone.',
                        'instructions' => $instructions,
                        'status_code' => $statusCode
                    ]);
                }

                // ✅ 000 → Payment already completed (rare here)
                if ($statusCode == '000') {

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Payment successful',
                        'status_code' => $statusCode
                    ]);
                }

                // ❌ Everything else = error
                return response()->json([
                    'status' => 'error',
                    'message' => $message,
                    'status_code' => $statusCode
                ], 400);

            } catch (\Exception $e) {
                Log::error('DPO Error', [
                    'error' => $e->getMessage()
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Mobile money charge failed' . $e->getMessage()
                ], 500);
            }

        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid payment method'
        ], 400);
    }

    /**
     * STEP 3: Verify Token (Confirm Payment)
     */
    public function verifyToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $xml = "
        <API3G>
            <CompanyToken>{$this->companyToken}</CompanyToken>
            <Request>verifyToken</Request>
            <TransactionToken>{$request->token}</TransactionToken>
        </API3G>";

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/xml'
            ])->send('POST', $this->baseUrl, [
                'body' => $xml
            ]);

            $body = simplexml_load_string($response->body());
            $payment = Payment::where('transaction_token', $request->token)->first();

            // Log full response for debugging
            Log::info('DPO Verify Response', [
                'response' => $response->body(),
                'statusCode' => (string) ($body->StatusCode),
                'message' => (string) ($body->ResultExplanation ?? 'No message'),
                'result' => (string) ($body->Result)
            ]);

            if (isset($body->Result) && $body->Result == "000") {
               
                $participant = Participant::where('transaction_token', $request->token)->first();

                

                 if (!$participant) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Participant not found'
                    ], 404);
                }

                if ($participant) {

                    // Only process if not already paid
                    if (!in_array('paid', $participant->product_status ?? [])) {

                        // $participant->payment_status = 'paid';
                        $participant->product_status = ['paid','registered'];
                        $participant->ticket_code = 'EPD2026-' . strtoupper(Str::random(10));
                        $participant->save();

                        Log::info('TEST: Payment verified for participant', [
                            'email' => $participant->email,
                            'participant_id' => $participant->id,
                            'transaction_token' => $participant->transaction_token,
                            'ticket_package' => $participant->ticket_package,
                            'payment_status' => $participant->payment_status,
                            'product_status' => $participant->product_status,
                            'ticket_code' => $participant->ticket_code
                        ]);

                        // ✅ Generate QR SVG and store temporarily
                        $qrData = url('/ticket/' . $participant->ticket_code);
                        
                        $qrSvg = QrCode::size(200)->format('svg')->generate($qrData);

                        $tempPath = storage_path('app/public/qr_temp_' . $participant->id . '.svg');
                        file_put_contents($tempPath, $qrSvg);

                        // ✅ Generate PDF referencing the SVG file
                        $pdf = Pdf::loadView('pdf.ticket', [
                            'participant' => $participant,
                            'qrPath' => $tempPath
                        ]);

                        // ✅ Send email
                        Mail::to($participant->email)->send(
                            new TicketMail($participant, $pdf->output())
                        );

                        // ✅ Clean up temp file
                        @unlink($tempPath);

                        Log::info('TEST: Ticket email sent', [
                            'email' => $participant->email
                        ]);
                    }
                }

                if ($payment) {
                    $payment->update([
                        'status' => 'paid',
                        'response_message' => 'Payment successful',
                        'paid_at' => now(),
                        'raw_response' => json_decode(json_encode($body), true),
                    ]);
                }

                return response()->json([
                    'status' => 'success',
                    'message' => 'Payment successful'
                ]);
            }



            if ($payment) {
                $payment->update([
                    'status' => 'pending',
                    'response_message' => (string) ($body->ResultExplanation ?? 'Pending'),
                    'raw_response' => json_decode(json_encode($body), true),
                ]);
            }

            // You can improve this with more status checks
            return response()->json([
                'status' => 'pending',
                'message' => 'Payment not completed yet'
            ]);

        } catch (\Exception $e) {
            Log::error('Verify Token Exception', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Verification failed'
            ], 500);
        }
    }

    public function verifyAllPayments()
{
    $participants = Participant::whereNotNull('transaction_token')->get();

    $updatedCount = 0;

    foreach ($participants as $participant) {

        try {
            $xml = "
            <API3G>
                <CompanyToken>{$this->companyToken}</CompanyToken>
                <Request>verifyToken</Request>
                <TransactionToken>{$participant->transaction_token}</TransactionToken>
            </API3G>";

            $response = Http::withHeaders([
                'Content-Type' => 'application/xml'
            ])->send('POST', $this->baseUrl, [
                'body' => $xml
            ]);

            $body = simplexml_load_string($response->body());

            if (isset($body->Result) && $body->Result == "000") {

                $statuses = $participant->product_status ?? [];

                if (is_string($statuses)) {
                    $statuses = [$statuses];
                }

                if (!in_array('paid', $statuses)) {

                    $statuses[] = 'paid';
                    $statuses[] = 'registered';

                    $participant->product_status = array_unique($statuses);
                    $participant->payment_status = 'paid';

                    // Generate ticket only if not exists
                    if (!$participant->ticket_code || $participant->ticket_code == 'Not Generated') {
                        $participant->ticket_code = 'EPD2026-' . strtoupper(Str::random(10));
                    }

                    $participant->save();
                    $updatedCount++;
                }
            }

        } catch (\Exception $e) {
            Log::error('Bulk Verify Error', [
                'participant_id' => $participant->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => "$updatedCount participants updated"
    ]);
}

    public function getByTicketCode($ticket_code)
    {
        $participant = Participant::where('ticket_code', $ticket_code)->first();

        Log::info('Get Participant by Ticket Code', [
            'ticket_code' => $ticket_code,
            'participant_found' => $participant ? true : false
        ]);

        if (!$participant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or unknown ticket'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $participant
        ]);
    }




    public function show($code)
    {
        $participant = Participant::where('ticket_code', $code)->firstOrFail();

        return view('epd.ticket', compact('participant'));
    }

 public function updateStatus(Request $request, $code)
{
    $participant = Participant::where('ticket_code', $code)->firstOrFail();

    $request->validate([
        'status' => 'required|array'
    ]);

    $existing = $participant->product_status ?? [];

    if (is_string($existing)) {
        $existing = json_decode($existing, true) ?? [$existing];
    }

    $merged = array_unique(array_merge($existing, $request->status));

    $participant->product_status = $merged;
    $participant->save();

    return back()->with('success', 'Status updated successfully');
}

    private function generateAndSendTicket(Participant $participant)
{

    Log::info('Generating and sending ticket', [
        'participant_id' => $participant->id,
        'email' => $participant->email
    ]);

    try {
        // Ensure ticket_code exists
        if (!$participant->ticket_code || $participant->ticket_code === 'Not Generated') {
            $participant->ticket_code = 'EPD2026-' . strtoupper(Str::random(10));
            $participant->save();
        }

        // Generate QR
        $qrData = url('/ticket/' . $participant->ticket_code);
        $qrSvg = QrCode::size(200)->format('svg')->generate($qrData);

        $tempPath = storage_path('app/public/qr_temp_' . $participant->id . '.svg');
        file_put_contents($tempPath, $qrSvg);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', [
            'participant' => $participant,
            'qrPath' => $tempPath
        ]);

        // Send email
        Mail::to($participant->email)->send(
            new TicketMail($participant, $pdf->output())
        );

        // Clean up
        @unlink($tempPath);

        Log::info('Ticket regenerated and sent', [
            'participant_id' => $participant->id,
            'email' => $participant->email
        ]);

        return true;

    } catch (\Exception $e) {
        Log::error('Ticket resend failed', [
            'participant_id' => $participant->id,
            'error' => $e->getMessage()
        ]);

        return false;
    }
}

public function resendTicket(Request $request)
{
    $request->validate([
        'participant_id' => 'required|exists:participants,id',
        'ticket_code' => 'required|string'
    ]);

    Log::info('Resend Ticket Request', [
        'participant_id' => $request->participant_id,
        'ticket_code' => $request->ticket_code
    ]);

    $participant = Participant::where('id', $request->participant_id)
        ->where('ticket_code', $request->ticket_code)
        ->first();

    if (!$participant) {
        return response()->json([
            'status' => 'error',
            'message' => 'Participant not found or ticket mismatch'
        ], 404);
    }

    $sent = $this->generateAndSendTicket($participant);

    Log::info('Resend Ticket Result', [
        'participant_id' => $participant->id,
        'email' => $participant->email,
        'sent' => $sent
    ]);

    return response()->json([
        'status' => $sent ? 'success' : 'error',
        'message' => $sent ? 'Ticket resent successfully' : 'Failed to resend ticket'
    ]);
}


    
// public function testPaymentSuccess(Request $request)
// {
//     $request->validate([
//         'token' => 'required|string'
//     ]);

//     try {
//         $participant = Participant::where('transaction_token', $request->token)->first();

//         if (!$participant) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Participant not found'
//             ], 404);
//         }

//         // if ($participant->payment_status !== 'paid') {
//             $participant->payment_status = 'paid';
//             $participant->save();

//             Log::info('TEST: Payment verified for participant', [
//                 'email' => $participant->email,
//                 'participant_id' => $participant->id
//             ]);

//             // ✅ Generate QR SVG and store temporarily
//             $qrData = url('/ticket/' . $participant->id);
            
//             $qrSvg = QrCode::size(200)->format('svg')->generate($qrData);

//             $tempPath = storage_path('app/public/qr_temp_' . $participant->id . '.svg');
//             file_put_contents($tempPath, $qrSvg);

//             // ✅ Generate PDF referencing the SVG file
//             $pdf = Pdf::loadView('pdf.ticket', [
//                 'participant' => $participant,
//                 'qrPath' => $tempPath
//             ]);

//             // ✅ Send email
//             Mail::to($participant->email)->send(
//                 new TicketMail($participant, $pdf->output())
//             );

//             // ✅ Clean up temp file
//             @unlink($tempPath);

//             Log::info('TEST: Ticket email sent', [
//                 'email' => $participant->email
//             ]);
//         // }

//         return response()->json([
//             'status' => 'success',
//             'message' => 'TEST: Payment simulated successfully and email sent'
//         ]);

//     } catch (\Exception $e) {
//         Log::error('TEST: Payment simulation failed', [
//             'error' => $e->getMessage()
//         ]);

//         return response()->json([
//             'status' => 'error',
//             'message' => 'Test failed'
//         ], 500);
//     }
// }


    }