@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="row">
        <div class="col-md-7">

            <canvas id="chartMonth"></canvas>
        </div>
        <div class="col-md-5 " style="">
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
            <div class="row align-items-center">
                <form action="" class="d-flex" style="align-items: baseline">

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
            <div class="card mb-4 text-white bg-success" style="height:150px; margin-top: 10px">
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
    <div class="table-responsive">
        <table class="table border mb-0">
            <thead class="table-light fw-semibold">
                <tr class="align-middle">
                    <th class="text-center">
                        <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                        </svg>
                    </th>
                    <th>Phim</th>
                    <th class="text-center">Ngày bắt đầu chiếu</th>

                    <th class="text-center">Tổng doanh số</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenues as $reven)
                <tr class="align-middle">
                    <td class="text-center">
                        <div class="avatar avatar-md"><img class="avatar-img" src="{{}}"
                                alt=""><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td>
                        <div>Yiorgos Avraamu</div>

                    </td>

                    <td>
                        <div class="clearfix">
                            <div class="float-start">
                                <div class="fw-semibold">50%</div>
                            </div>
                            <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small>
                            </div>
                        </div>
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </td>
                    <td class="text-center">
                        <svg class="icon icon-xl">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                        </svg>
                    </td>

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
