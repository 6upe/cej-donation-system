@extends('layouts.dashboard.app')

@section('content')

<div class="card">
    <div class="card-body">
        
        
        <div class="row mt-4">
            <!-- Summary Cards -->
            <div class="col-md-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title text-white">Total Donations</h5>
                        <p class="card-text fs-3">$ {{ number_format($totalDonationsUSD, 2) }}</p>
                        <p class="card-text fs-3">ZMW {{ number_format($totalDonationsZMW, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title text-white">Highest Donation</h5>
                        <p class="card-text fs-3">$ {{ number_format($highestDonationUSD, 2) }}</p>
                        <p class="card-text fs-3">ZMW {{ number_format($highestDonationZMW, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title text-white">Total Donors</h5>
                        <p class="card-text fs-3">{{ $totalDonors }}</p>
                    </div>
                </div>
            </div>
        </div>


            <!-- Donation Table -->
    <div class="table-responsive mt-4">
        <h5 class="card-title">All Donations</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>Donor Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->donor->first_name }} {{ $donation->donor->last_name }}</td>
                    <td>{{ $donation->donation_currency }} {{ number_format($donation->donation_amount, 2) }}</td>
                    <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('donations.invoice', $donation->id) }}" class="btn btn-primary btn-sm">Generate Invoice</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Monthly Donation Summary -->
    <div class="table-responsive mt-4">
        <h5 class="card-title">Monthly Donation Summary (ZMW)</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Total Donations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donationsByMonthZMW as $month)
                <tr>
                    <td>{{ $month->year }}</td>
                    <td>{{ DateTime::createFromFormat('!m', $month->month)->format('F') }}</td>
                    <td>
                      ZMW {{ number_format($month->total, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="table-responsive mt-4">
        <h5 class="card-title">Monthly Donation Summary (USD)</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Total Donations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donationsByMonthUSD as $month)
                <tr>
                    <td>{{ $month->year }}</td>
                    <td>{{ DateTime::createFromFormat('!m', $month->month)->format('F') }}</td>
                    <td>
                      ${{ number_format($month->total, 2) }}
                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </div>



</div>

@endsection
