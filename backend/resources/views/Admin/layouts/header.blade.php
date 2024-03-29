<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <link rel="manifest" href="{{ asset('dist/assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('dist/assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('dist/vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/vendors/simplebar.css') }}">
    <!-- Main styles for this application-->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{ asset('dist/css/examples.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('uploads/logo/logo.png') }}" />
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared IDchuyên
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="{{ asset('dist/vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        input[type="checkbox"][aria-disabled="true"] {
            background-color: blue;
            pointer-events: none;
        }

        .custom-switch .custom-control-input:disabled:checked~.custom-control-label::before {
            background-color: #007bff;
        }

        .apex-charts {
            min-height: 10px !important
        }

        .apex-charts text {
            font-family: var(--bs-font-sans-serif) !important;
            fill: #adb5bd
        }

        .apex-charts .apexcharts-canvas {
            margin: 0 auto
        }

        .apexcharts-tooltip-text,
        .apexcharts-tooltip-title {
            font-family: var(--bs-font-sans-serif) !important
        }

        .apexcharts-legend-series {
            font-weight: 500
        }

        .apexcharts-gridline {
            pointer-events: none;
            stroke: #f8f9fa
        }

        .apexcharts-legend-text {
            color: #74788d !important;
            font-family: var(--bs-font-sans-serif) !important;
            font-size: 13px !important
        }

        .apexcharts-pie-label {
            fill: #fff !important
        }

        .apexcharts-xaxis text,
        .apexcharts-yaxis text {
            font-family: var(--bs-font-sans-serif) !important;
            fill: #adb5bd
        }

        .e-charts {
            height: 350px
        }
    </style>
</head>

<body>

    @include('Admin.layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="{{ asset('dist/assets/brand/free.svg#cil-list-rich') }}"></use>
                    </svg></a>
                <ul class="header-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg text-danger">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                            </svg></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                            </svg></a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                            <svg class="icon icon-lg">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                            </svg></a></li>
                </ul>
                <ul class="header-nav ms-3">
                    <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img" src="{{ Auth::user()->image }}"
                                    alt="user@email.com">
                            </div>
                        </a>
                        <!-- account -->
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2">
                                <div class="fw-semibold">Settings</div>
                            </div><a class="dropdown-item" href="{{ route('users.change_password') }}">
                                <svg class="icon me-2">
                                    <use
                                        xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-settings') }}">
                                    </use>
                                </svg> Đổi mật khẩu</a><a class="dropdown-item" href="">
                                <div class="dropdown-divider"></div><a class="dropdown-item"
                                    href="{{ route('logout') }}">
                                    <svg class="icon me-2">
                                        <use
                                            xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-account-logout') }}">
                                        </use>
                                    </svg> Đăng Xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
            {{-- <div class="header-divider"></div> --}}
            {{-- <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-0 ms-2">
                        <li class="breadcrumb-item">
                            <!-- if breadcrumb is single--><span>Home</span>
                        </li>
                        <li class="breadcrumb-item active"><span>Dashboard</span></li>
                    </ol>
                </nav>
            </div> --}}
        </header>
