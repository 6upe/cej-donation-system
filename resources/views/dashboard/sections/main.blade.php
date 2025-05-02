@extends('layouts.dashboard.app')

@section('content')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-6">
            <!-- Yearly Donations -->
            <div class="card overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Yearly Donations</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3">${{ number_format($yearlyDonationsUSD, 2) }}</h4>
                            <div class="d-flex align-items-center mb-3">
                                <span
                                    class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-up-left text-success"></i>
                                </span>
                                <p class="text-dark me-1 fs-3 mb-0">ZMW</p>
                                <p class="fs-3 mb-0">{{ number_format($yearlyDonationsZMW, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <div id="breakup"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Monthly Donations -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Monthly Donations</h5>
                            <h4 class="fw-semibold mb-3">${{ number_format($monthlyDonationsUSD, 2) }}</h4>
                            <div class="d-flex align-items-center pb-1">
                                <span
                                    class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-down-right text-danger"></i>
                                </span>
                                <p class="text-dark me-1 fs-3 mb-0">ZMW</p>
                                <p class="fs-3 mb-0">{{ number_format($monthlyDonationsZMW, 2) }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-currency-dollar fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="earning"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Recent Donations</h5>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                        @foreach ($recentDonations as $donation)
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time text-dark flex-shrink-0 text-end">
                                    {{ $donation->created_at->format('h:i A') }}
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">
                                    Payment received from {{ $donation->donor->name ?? 'Anonymous' }} of
                                    {{ $donation->donation_currency }} {{ number_format($donation->donation_amount, 2) }}
                                </div>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">
                        Donation Summary</h5>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Id</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Donor</h6>
                                    </th>

                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Amount</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Date</h6>
                                    </th>
                                    {{-- <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
                                    </th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donationSummary as $donation)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $donation->id }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">
                                                {{ $donation->donor->organization_name ?? 'Anonymous' }}</h6>
                                            <span
                                                class="fw-semibold mb-1">{{ $donation->donor->first_name ?? 'No Email' }}</span>
                                            <br>
                                            <span class="fw-normal">{{ $donation->donor->email ?? 'No Email' }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0 fs-4">{{ $donation->donation_currency }}
                                                {{ number_format($donation->donation_amount, 2) }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $donation->created_at->format('M d, Y') }}</p>
                                        </td>
                                        {{-- <td class="border-bottom-0">
                                          <span class="badge bg-success rounded-3 fw-semibold">{{ $donation->status }}</span>
                                      </td> --}}

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
