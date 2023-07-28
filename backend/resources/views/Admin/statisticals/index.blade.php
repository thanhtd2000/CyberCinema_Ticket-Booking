@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div>
        <canvas id="chartMonth"></canvas>
    </div>
    @foreach($orderMonth as $order)
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tháng {{$order->order_month}}
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </div>
    @endforeach
    <script>
        const chartData = JSON.parse('{!! $chartData !!}');
        console.log(chartData)
        const ctx = document.getElementById('chartMonth');

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
