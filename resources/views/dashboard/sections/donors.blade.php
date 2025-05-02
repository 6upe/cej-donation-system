@extends('layouts.dashboard.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <h5 class="card-title fw-semibold mb-4">Donors Page</h5>
            </div>

            <!-- Search Input -->
            <input type="text" id="donorSearch" class="form-control mb-4" placeholder="Search by donor name or organization...">

            <div class="row" id="donorList">
                @foreach($donors as $donor)
                    <div class="col-md-6 donor-card" 
                         data-name="{{ strtolower($donor->first_name . ' ' . $donor->last_name . ' ' . $donor->organization_name) }}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $donor->first_name }} {{ $donor->last_name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $donor->organization_name ?? 'No Organization' }}</h6>
                                <span>{{ $donor->email }} </span> <br>
                                <span>{{ $donor->address }} </span> <br>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Donation Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($donor->donations as $donation)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                                                <td>{{ $donation->donation_currency }} {{ number_format($donation->donation_amount, 2) }}</td>
                                                <td>{{ ucfirst($donation->status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- JavaScript for Filtering -->
    <script>
        document.getElementById("donorSearch").addEventListener("keyup", function() {
            let searchValue = this.value.toLowerCase();
            let donorCards = document.querySelectorAll(".donor-card");

            donorCards.forEach(card => {
                let name = card.getAttribute("data-name");
                if (name.includes(searchValue)) {
                    card.style.display = "block"; // Show matching donor
                } else {
                    card.style.display = "none"; // Hide non-matching donor
                }
            });
        });
    </script>
@endsection
