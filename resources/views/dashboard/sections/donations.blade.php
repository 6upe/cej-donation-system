@extends('layouts.dashboard.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Donations Page</h5>

            <div class="d-flex justify-content-between text-right mb-3">
                <p class="mb-0"></p>

                <select class="form-select form-select-sm filter-input" data-column="1">
                    <option value="">Donation Type</option>
                </select>

                <select class="form-select form-select-sm filter-input" data-column="3">
                    <option value="">Currency</option>
                </select>
                <select class="form-select form-select-sm filter-input" data-column="4">
                    <option value="">Status</option>
                    <option value="completed">Completed</option>
                    <option value="Submitted">Submitted</option>
                </select>

                <button id="exportExcel" type="button" class="btn btn-outline-success m-1">Export Statement</button>

            </div>

            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle" id="donationTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>Donor Info</th>
                                <th>
                                    Donation Type
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Currency
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>Transaction Token</th>
                                <th>Transaction ID</th>
                                <th>Company Ref</th>

                                <th>CCD Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>

                                    <td>
                                        {{ $donation->donor->first_name }} {{ $donation->donor->last_name }}<br>
                                        {{ $donation->donor->email }}<br>
                                        {{ $donation->donor->organization_name ?? 'N/A' }}
                                    </td>
                                    <td>{{ $donation->donation_type }}</td>
                                    <td>{{ $donation->donation_amount }}</td>
                                    <td>{{ $donation->donation_currency }}</td>
                                    <td><span class="badge bg-primary">{{ ucfirst($donation->status) }}</span></td>
                                    <td>{{ $donation->transaction_token }}</td>
                                    <td>{{ $donation->transaction_id }}</td>
                                    <td>{{ $donation->company_ref }}</td>
                                    <td>{{ $donation->ccd_approval }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                   
                </div>
            </div>

            
        </div>

        <!-- Pagination -->
        <!-- <div class="row">
            <div class="col-12 d-flex justify-content-center" style="height: 10px;">
                {{ $donations->links() }}
            </div>
        </div> -->
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById("donationTable");
            const filters = document.querySelectorAll(".filter-input");

            // Function to get unique values for a specific column
            function getUniqueValues(column) {
                let values = new Set();
                const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

                for (let row of rows) {
                    let cell = row.getElementsByTagName("td")[column];
                    if (cell) {
                        values.add(cell.textContent.trim());
                    }
                }
                return Array.from(values).sort();
            }

            // Populate dropdown filters with unique values
            filters.forEach(filter => {
                let column = filter.dataset.column;
                let uniqueValues = getUniqueValues(column);

                uniqueValues.forEach(value => {
                    let option = document.createElement("option");
                    option.value = value.toLowerCase();
                    option.textContent = value;
                    filter.appendChild(option);
                });

                // Listen for filter changes
                filter.addEventListener("change", function() {
                    filterTable();
                });
            });

            // Function to filter table rows
            function filterTable() {
                const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

                for (let row of rows) {
                    let showRow = true;

                    filters.forEach(filter => {
                        let column = filter.dataset.column;
                        let value = filter.value.toLowerCase();
                        let cell = row.getElementsByTagName("td")[column];

                        if (cell) {
                            let cellText = cell.textContent.trim().toLowerCase();
                            if (value && cellText !== value) {
                                showRow = false;
                            }
                        }
                    });

                    row.style.display = showRow ? "" : "none";
                }
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function getVisibleRows() {
                return [...document.querySelectorAll("#donationTable tbody tr")].filter(row => row.style.display !==
                    "none");
            }

            function downloadExcel() {
                let table = document.getElementById("donationTable");
                let rows = getVisibleRows();
                let wb = XLSX.utils.book_new();
                let ws_data = [];

                // Add table headers (only the text, ignoring <select> inputs)
                let headers = [...table.querySelectorAll("thead th")]
                    .map(th => th.innerText.trim()); // This will exclude any <select> content
                ws_data.push(headers);

                // Add table rows
                rows.forEach(row => {
                    let rowData = [...row.querySelectorAll("td")].map(td => td.innerText.trim());
                    ws_data.push(rowData);
                });

                let ws = XLSX.utils.aoa_to_sheet(ws_data);
                XLSX.utils.book_append_sheet(wb, ws, "Donations");

                // Export Excel file
                XLSX.writeFile(wb, "filtered_donations.xlsx");
            }

            // Attach event listeners to buttons
            document.getElementById("exportExcel").addEventListener("click", downloadExcel);
        });
    </script>
@endsection
