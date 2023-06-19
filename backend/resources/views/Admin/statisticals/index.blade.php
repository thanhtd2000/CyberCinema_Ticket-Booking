@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    {{-- <canvas class="chart" id="card-chart1" height="87" width="312" style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas> --}}
    <div class="row">
        <div class="col-md-6 ">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                                </svg>)</span></div>
                        <div>Users</div>
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
                    <canvas class="chart" id="card-chart1" height="87" width="312"
                        style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas>
                    <div class="chartjs-tooltip" style="opacity: 0; left: 260.6px; top: 144.007px;">
                        <table style="margin: 0px;">
                            <thead class="chartjs-tooltip-header">
                                <tr class="chartjs-tooltip-header-item" style="border-width: 0px;">
                                    <th style="border-width: 0px;">July</th>
                                </tr>
                            </thead>
                            <tbody class="chartjs-tooltip-body">
                                <tr class="chartjs-tooltip-body-item">
                                    <td style="border-width: 0px;"><span
                                            style="background: rgb(50, 31, 219); border-color: rgba(255, 255, 255, 0.55); border-width: 2px; margin-right: 10px; height: 10px; width: 10px; display: inline-block;"></span>My
                                        First dataset: 40</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-md-6 ">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                                <svg class="icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                                </svg>)</span></div>
                        <div>Income</div>
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
                    <canvas class="chart" id="card-chart2" height="87" width="312"
                        style="display: block; box-sizing: border-box; height: 69.6px; width: 249.6px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="col">
            <div class="card mb-4">
                <div class="card-header"><strong>Chart</strong><span class="small ms-1">Bar</span></div>
                <div class="card-body">
                    <div class="example">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-coreui-toggle="tab"
                                    href="#preview-1105" role="tab" aria-selected="true">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
                                    </svg>Preview</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="http://www.chartjs.org/"
                                    target="_blank" aria-selected="false" tabindex="-1" role="tab">
                                    <svg class="icon me-2">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-code"></use>
                                    </svg>Code</a></li>
                        </ul>
                        <div class="tab-content rounded-bottom">
                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1105">
                                <div class="c-chart-wrapper">
                                    <canvas id="canvas-2" width="657" height="328"
                                        style="display: block; box-sizing: border-box; height: 262.4px; width: 525.6px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
