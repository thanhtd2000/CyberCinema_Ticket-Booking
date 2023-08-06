@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<div class="row align-items-center" style="margin-bottom: 10px">
    <form action="" class="d-flex" style="align-items: baseline; justify-content: flex-end">

        <label for="">Từ</label>
        <div class="col-auto">

            <input type="date" id="date1" class="form-control" value="">
        </div>
        <label for="">đến</label>
        <div class="col-auto">

            <input type="date" id="date2" class="form-control" value="">
        </div>

        <button type="button" class="btn btn-primary total-search" id=""><i
                class="fas fa-search"></i></button>
    </form>
</div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 text-white bg-info" style="height:150px">
                <div class="card-body pb-0 " style="">
                    <div>
                        <div class="fs-4 fw-semibold" style="text-align: center">Doanh số hôm nay</div>
                        <div style="text-align: center; font-weight: bold ; font-size: 20px ; ">
                            {{ isset($orderDate->total_sum) ? number_format($orderDate->total_sum) : 0 }} VND</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a
                                class="dropdown-item" href="#">Another action</a><a class="dropdown-item"
                                href="#">Something else here</a></div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
            
        </div>
        <div class="col-md-6 " style="">
            
            
            <div class="card mb-4 text-white bg-success" style="height:150px;">
                <div class="card-body pb-0 " style="">
                    <div>
                        <div class="fs-4 fw-semibold" style="text-align: center">Doanh số </div>
                        <div style="text-align: center; font-weight: bold ; font-size: 20px ; " class="total-sum">VND</div>
                    </div>

                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div>
        <canvas id="chartMonth" style="height: 200px"></canvas>
    </div>
   
    <div class="row" style="margin-top: 20px">

        <div class="col-md-7">
            <table class="table border mb-0">
                <thead class="table-light fw-semibold">
                    <tr class="align-middle">
                        <th class="text-center">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                            </svg>
                        </th>
                        <th>Phim</th>
                       
                        <th class="text-center">Tổng doanh số</th>
    
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($revenues as $reven)
                    <tr class="align-middle">
                        <td class="text-center">
                            <div class="avatar avatar-md"><img class="avatar-img" src="{{$reven->image}}"
                                    alt=""></div>
                        </td>
                        <td>
                            <div style="font-weight: bold">{{$reven->name}}</div>
    
                        </td>
    
                      
                        <td class="text-center" style="font-weight: bold">{{number_format($reven->total_revenue)}} VND</td>
    
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                        </use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table border mb-0">
                <thead class="table-light fw-semibold">
                    <tr class="align-middle">
                        <th class="text-center">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                            </svg>
                        </th>
                        <th>Sản phẩm</th>
                       
                        <th class="text-center">Tổng doanh số</th>
    
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="align-middle">
                        <td class="text-center">
                            <div class="avatar avatar-md"><img class="avatar-img" src="{{$product->image}}"
                                    alt=""></div>
                        </td>
                        <td>
                            <div style="font-weight: bold">{{$product->name}}</div>
    
                        </td>
    
                      
                        <td class="text-center" style="font-weight: bold">{{number_format($product->orderProducts->sum('total'))}} VND</td>
    
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                        </use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
        const labels = Utils.months({count: 7});
        const data = {
        labels: labels,
        datasets: [{
            label: 'My First Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
            ],
            borderWidth: 1
        }]
        };
    </script>
    <script>
        $(document).on('click', '.total-search', function(e) {
            // var month = $(this).data('month');
            var dateStart = $("#date1").val();
            var dateEnd = $("#date2").val();
            // console.log(dateStart);

            $.ajax({
                url: '/admin/showMonth',
                type: 'GET',
                data: {
                    dateStart: dateStart,
                    dateEnd: dateEnd
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data.orderDate);
                    $('.total-sum').text(new Intl.NumberFormat().format(data.orderDate.total) + ' ' +
                        'VND');

                },
                error: function(error) {
                    console.error('Error while fetching data:', error);
                }
            });
        });
    </script>
@endsection
