@extends(Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Dashboard')
@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <form action="{{ route('dashboard') }}" method="GET" class="d-flex align-items-center">
                <label for="year" class="me-2 fw-bold">Filter by Year:</label>
                <select name="year" id="year" class="form-select w-auto d-inline-block me-2">
                    @isset($years)
                    @foreach($years as $yr)
                        <option value="{{ $yr }}" {{ (isset($selectedYear) && $selectedYear == $yr) ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                    @endisset
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Monthly Analysis Overview</h4>
                    <div style="height: 350px;">
                        <canvas id="farmersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Data Table</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Returning Farmers</th>
                                    <th>Total Samples</th>
                                    <th>Analysis Done</th>
                                </tr>
                            </thead>
                            <tbody>
                            @isset($monthlyData)
                            @foreach ($monthlyData as $data)
                                <tr>
                                    <td>{{ $data['month'] }}</td>
                                    <td>{{ $data['returningFarmers'] }}</td>
                                    <td>{{ $data['totalSamples'] }}</td>
                                    <td>{{ $data['analyzedSamples'] }}</td>
                                </tr>
                            @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script>
        // Your chart creation code will go here
        const monthlyData = @json($monthlyData);

        const ctx = document.getElementById('farmersChart').getContext('2d');
        const farmersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyData.map(data => data.month),
                datasets: [{
                        label: 'Returning Farmers',
                        data: monthlyData.map(data => data.returningFarmers),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    },
                    {
                        label: 'Total Samples',
                        data: monthlyData.map(data => data.totalSamples),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    },
                    {
                        label: 'Analyzed Samples',
                        data: monthlyData.map(data => data.analyzedSamples),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    },
                },
            },
        });
    </script>
@endsection
