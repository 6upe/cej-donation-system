<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Participant;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;



class DashboardController extends Controller
{

    public function __construct()
    {
        $userFirstName = auth()->user()->first_name;
        view()->share('userFirstName', $userFirstName);
    }

    public function index()
    {
        // Fetch yearly and monthly completed donations
        $yearlyDonations = Donation::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->sum('donation_amount');

        $monthlyDonations = Donation::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('donation_amount');


        $yearlyDonationsUSD = 0;
        $monthlyDonationsUSD = 0;
        $yearlyDonationsZMW = 0;
        $monthlyDonationsZMW = 0;

        $yearlyDonationsData = Donation::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->get();

        $monthlyDonationsData = Donation::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->get();

        foreach ($yearlyDonationsData as $donation) {
            if ($donation->currency == 'USD') {
                $yearlyDonationsUSD += $donation->donation_amount;
            } else {
                $yearlyDonationsZMW += $donation->donation_amount;
            }
        }

        foreach ($monthlyDonationsData as $donation) {

            if ($donation->currency == 'USD') {
                $monthlyDonationsUSD += $donation->donation_amount;
            } else {
                $monthlyDonationsZMW += $donation->donation_amount;
            }
        }


        // Fetch recent donations (last 5 completed donations)
        $recentDonations = Donation::where('status', 'completed')
            ->latest()
            ->limit(5)
            ->get();

        // Fetch summarized donation data
        $donationSummary = Donation::where('status', 'completed')
            ->select('id', 'donor_id', 'donation_amount', 'created_at', 'status', 'donation_currency')
            ->with('donor') // Assuming a Donor model relation
            ->latest()
            ->limit(5)
            ->get();


        $userFirstName = auth()->user()->first_name;


        return view('dashboard.sections.main', [
            'title' => 'Home',
            'yearlyDonations' => $yearlyDonations,
            'yearlyDonationsUSD' => $yearlyDonationsUSD,
            'monthlyDonations' => $monthlyDonations,
            'monthlyDonationsUSD' => $monthlyDonationsUSD,
            'recentDonations' => $recentDonations,
            'donationSummary' => $donationSummary,
            'yearlyDonationsZMW' => $yearlyDonationsZMW,
            'monthlyDonationsZMW' => $monthlyDonationsZMW,
            'userFirstName' => $userFirstName
        ]);
    }





    public function home()
    {
        return $this->index(); // Reuse index method
    }

    public function donations()
    {
        $donations = Donation::with('donor')
            ->latest()
            ->paginate(10);

        $userFirstName = auth()->user()->first_name;

        return view('dashboard.sections.donations', [
            'title' => 'Donations',
            'donations' => $donations,
            'userFirstName' => $userFirstName
        ]);
    }


    public function donors()
{
    $donors = Donor::whereHas('donations', function ($query) {
        $query->where('status', 'completed');
    })->with([
        'donations' => function ($query) {
            $query->where('status', 'completed');
        }
    ])->latest()->paginate(10); // Only donors with completed donations

    $userFirstName = auth()->user()->first_name;

    return view('dashboard.sections.donors', [
        'title' => 'Donors',
        'donors' => $donors,
        'userFirstName' => $userFirstName
    ]);
}



    public function reports()
    {

        $donations = Donation::with('donor')->where('status', '=', 'completed')->latest()->get(); // Fetch all donations with donor details

        $donationsByMonthZMW = Donation::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(donation_amount) as total')
            ->where('status', '=', 'completed')
            ->where('donation_currency', '=', 'ZMW')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $donationsByMonthUSD = Donation::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(donation_amount) as total')
            ->where('donation_currency', '=', 'USD')
            ->where('status', '=', 'completed')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();




        // Calculate total donations for each currency
        $totalDonationsUSD = Donation::where('donation_currency', 'USD')->where('status', '=', 'completed')->sum('donation_amount');
        $totalDonationsZMW = Donation::where('donation_currency', 'ZMW')->where('status', '=', 'completed')->sum('donation_amount');

        $highestDonationUSD = Donation::where('donation_currency', 'USD')->where('status', '=', 'completed')->max('donation_amount'); // Highest single donation
        $highestDonationZMW = Donation::where('donation_currency', 'ZMW')->where('status', '=', 'completed')->max('donation_amount'); // Highest single donation

        $totalDonors = Donor::count(); // Total number of donors
        $userFirstName = auth()->user()->first_name;
        return view('dashboard.sections.reports', [
            'title' => 'Reports',
            'donations' => $donations,
            'donationsByMonthZMW' => $donationsByMonthZMW,
            'donationsByMonthUSD' => $donationsByMonthUSD,
            'totalDonationsUSD' => $totalDonationsUSD,
            'totalDonationsZMW' => $totalDonationsZMW,
            'highestDonationUSD' => $highestDonationUSD,
            'highestDonationZMW' => $highestDonationZMW,
            'totalDonors' => $totalDonors,
            'userFirstName' => $userFirstName
        ]);
    }


    public function help()
    {
        $userFirstName = auth()->user()->first_name;
        return view('dashboard.sections.help', [
            'title' => 'Help',
            'userFirstName' => $userFirstName
        ]);
    }

    public function payments()
    {
        $payments = \App\Models\Payment::with('participant')
            ->latest()
            ->paginate(15);

        return view('dashboard.epd-payments.index', compact('payments'));
    }


    public function epdParticipants()
    {
        $participants = Participant::latest()->paginate(10);
        
        $totalPaidAmount = Payment::where('status', 'paid')
        ->sum('amount');

        $totalPaidCount = Payment::where('status', 'paid')
            ->count();

        return view('dashboard.sections.epd_participants', compact('participants', 'totalPaidAmount', 'totalPaidCount'));
    }

public function updateStatusAjax(Request $request)
{
    $request->validate([
        'participant_id' => 'required|exists:participants,id',
        'status' => 'required|array',
    ]);

    $participant = Participant::findOrFail($request->participant_id);

    // Get current statuses safely
    $existing = $participant->product_status ?? [];

    // Fix corrupted data
    if (is_string($existing)) {
        $decoded = json_decode($existing, true);
        $existing = is_array($decoded) ? $decoded : [$existing];
    }

    // Flatten in case of nested arrays
    $existing = collect($existing)
        ->flatten()
        ->map(fn($s) => is_string($s) ? trim($s) : $s)
        ->toArray();

    // Merge new statuses
    $newStatuses = $request->status;

    $merged = array_unique(array_merge($existing, $newStatuses));

    // Save clean array
    $participant->product_status = array_values($merged);
    $participant->save();

    return response()->json([
        'status' => 'success',
        'data' => $participant->product_status
    ]);
}
public function clearStatusAjax(Request $request)
{
    $request->validate([
        'participant_id' => 'required|exists:participants,id',
    ]);

    $participant = Participant::findOrFail($request->participant_id);

    // Reset to empty array OR default state
    $participant->product_status = []; 
    // OR if you prefer default:
    // $participant->product_status = ['initial'];

    $participant->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Status cleared successfully',
        'data' => $participant->product_status
    ]);
}



    public function search(Request $request)
{
    $query = \App\Models\Participant::query();

    // 🔍 SEARCH (partial matching)
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('ticket_code', 'LIKE', "%{$search}%");
        });
    }

    // 🎯 FILTER: PAYMENT STATUS
    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    // 🎯 FILTER: PACKAGE
    if ($request->filled('package')) {
        $query->where('ticket_package', $request->package);
    }

    $participants = $query->latest()->paginate(10)->withQueryString();

    return view('dashboard.sections.epd_participants', compact('participants'));
}

public function reconciliation()
{
    return view('dashboard.epd-payments.recon', [
        'title' => 'EPD Reconciliation'
    ]);
}

public function runReconciliation()
{
    $participants = \App\Models\Participant::all();
    $payments = \App\Models\Payment::all()->keyBy('transaction_token');

    $results = [];

    foreach ($participants as $p) {

        $payment = $payments[$p->transaction_token] ?? null;

        $issues = [];

        // ❌ Missing payment record
        if (!$payment) {
            $issues[] = 'Missing payment record';
        } else {

            // ❌ Amount mismatch
            if ($p->amount != $payment->amount) {
                $issues[] = 'Amount mismatch';
            }

            // ❌ Currency mismatch
            if ($p->currency != $payment->currency) {
                $issues[] = 'Currency mismatch';
            }

            // ❌ Status mismatch
            if ($p->payment_status !== $payment->status) {
                $issues[] = 'Status mismatch';
            }
        }

        $results[] = [
            'participant' => $p,
            'payment' => $payment,
            'issues' => $issues
        ];
    }

    return response()->json([
        'status' => 'success',
        'data' => $results
    ]);
}

public function verifyWithDPO()
{
    $results = [];

    \App\Models\Payment::chunk(5, function ($payments) use (&$results) {

        foreach ($payments as $payment) {

            // ✅ Skip already verified paid
            if ($payment->status === 'paid') {
                continue;
            }

            $xml = "
            <API3G>
                <CompanyToken>{$this->companyToken}</CompanyToken>
                <Request>verifyToken</Request>
                <TransactionToken>{$payment->transaction_token}</TransactionToken>
            </API3G>";

            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/xml'
                ])->send('POST', $this->baseUrl, [
                    'body' => $xml
                ]);

                $body = simplexml_load_string($response->body());

                $dpoStatus = (string) ($body->Result ?? 'unknown');

                $results[] = [
                    'token' => $payment->transaction_token,
                    'local_status' => $payment->status,
                    'dpo_status' => $dpoStatus,
                    'match' => $dpoStatus === '000'
                        ? $payment->status === 'paid'
                        : true
                ];

                // ✅ throttle (VERY IMPORTANT)
                sleep(2);

            } catch (\Exception $e) {

                $results[] = [
                    'token' => $payment->transaction_token,
                    'error' => $e->getMessage()
                ];
            }
        }

        // ✅ delay between chunks
        sleep(5);
    });

    return response()->json([
        'status' => 'success',
        'data' => $results
    ]);
}


}