<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Donor;



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
}
