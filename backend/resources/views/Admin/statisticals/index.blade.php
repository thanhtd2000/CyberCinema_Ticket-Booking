@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="row">
        <div class="col-md-7">

            <canvas id="chartMonth"></canvas>
        </div>
        <div class="col-md-5 " style="margin-top: 60px">
            <div class="card mb-4 text-white bg-info" style="height:200px">
              <div class="card-body pb-0 " style="padding-top: 30px">
                <div>
                  <div class="fs-4 fw-semibold" style="text-align: center">Doanh số hôm nay</div>
                  <div style="text-align: center; font-weight: bold ; font-size: 20px ; padding-top: 18px">{{number_format($orderDate->total_sum)}} VND</div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                    </svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                </div>
              </div>
              <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart2" height="70"></canvas>
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
            <tr class="align-middle">
              <td class="text-center">
                <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
              </td>
              <td>
                <div>Yiorgos Avraamu</div>
               
              </td>
             
              <td>
                <div class="clearfix">
                  <div class="float-start">
                    <div class="fw-semibold">50%</div>
                  </div>
                  <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                </div>
                <div class="progress progress-thin">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </td>
              <td class="text-center">
                <svg class="icon icon-xl">
                  <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                </svg>
              </td>
              
              <td>
                <div class="dropdown">
                  <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg class="icon">
                      <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-options') }}"></use>
                    </svg>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a></div>
                </div>
              </td>
            </tr>
            
          </tbody>
        </table>
      </div>
    {{-- <div class="month" style="display: flex">

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
    </div> --}}



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
                url: '/admin/showMonth',
                type: 'GET',
                data: {
                    month: month
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data.month);
                    const tableBody = $('.data-container');
                    tableBody.empty(); // Xóa dữ liệu cũ trước khi đổ mới
                    data.month.forEach(function(item) {
                        tableBody.append('<tr><td>' + item.order_date + '</td><td>' + new Intl
                            .NumberFormat().format(item.total_sum) + ' VND </td></tr>');
                    })
                },
                error: function(error) {
                    console.error('Error while fetching data:', error);
                }
            });
        });
    </script>
    <script>
        var options = {
            chart: {
                height: 350,
                type: "bar",
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    horizontal: !0
                }
            },
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: [380, 430, 450, 475, 550, 584, 780, 1100, 1220, 1365]
            }],
            colors: ["#34c38f"],
            grid: {
                borderColor: "#f1f1f1"
            },
            xaxis: {
                categories: ["South Korea", "Canada", "United Kingdom", "Netherlands", "Italy", "France", "Japan",
                    "United States", "China", "Germany"
                ]
            }
        };
        (chart = new ApexCharts(document.querySelector("#bar_chart"), options)).render();
    </script>
@endsection
