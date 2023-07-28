@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div>
        <canvas id="chartMonth"></canvas>
    </div>
    <div class="month" style="display: flex">

        @foreach ($orderMonth as $order)
            <button class="btn btn-primary month-button" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample-{{ $order->order_month }}" style="margin: 10px"
                data-month={{ $order->order_month }}>
                {{ $order->order_month }}
            </button>
        @endforeach
    </div>

    <div class="collapse" id="collapseExample">
        <div class="card card-body" style="padding: 0">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Ngày</th>
                        <th scope="col">Doanh số</th>
                    </tr>
                </thead>
                <tbody class="data-container">
                </tbody>
            </table>
        </div>
    </div>


  
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
    <script>
        $(document).on('click', '.month-button', function(e) {
            var month = $(this).data('month');
            $.ajax({
                url: '/admin/showMonth' ,
                type: 'GET',
                data: {
                    month: month
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data.month);
                    const tableBody = $('.data-container');
                    tableBody.empty(); // Xóa dữ liệu cũ trước khi đổ mới
                    data.month.forEach (function(item) {
                        tableBody.append('<tr><td>' + item.order_date + '</td><td>' + new Intl.NumberFormat().format(item.total_sum)  + ' VND </td></tr>');
                    })
                },
                error: function(error) {
                    console.error('Error while fetching data:', error);
                }
            });
        });
    </script>
@endsection
