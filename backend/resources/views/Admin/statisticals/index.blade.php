@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')

    <div>
        <canvas id="myChart"></canvas>
    </div>


    <script>
        const chartData = JSON.parse('{!! $chartData !!}');
        console.log(chartData)
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: chartData.datasets.label,
                    data: chartData.datasets.data,
                    borderWidth: chartData.datasets.borderWidth
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
