@extends('layouts.master')
@section('page_title', 'Add Farmer')
@section('content')
    <div>
        <canvas id="farmersChart"></canvas>
        <table border="1" class="table table-responsive" >
            <tr>
                <th>Month</th>
                <th>Returning Farmers</th>
                <th>Total Samples</th>
                <th>Analysis Done</th>
            </tr>
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
        </table>
    </div>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script>
        // Your chart creation code will go here
        const monthlyData = [{
                month: 'January',
                returningFarmers: 25,
                totalSamples: 100,
                analyzedSamples: 80
            },
            {
                month: 'February',
                returningFarmers: 30,
                totalSamples: 110,
                analyzedSamples: 90
            },
            {
                month: 'March',
                returningFarmers: 40,
                totalSamples: 120,
                analyzedSamples: 100
            },
            // Add data for more months...
        ];

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
