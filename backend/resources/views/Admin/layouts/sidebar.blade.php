<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{ route('admin.index') }}">
            <img class="sidebar-brand-full" width="100" height="40" src="../../uploads/logo/cgv.png"
                alt="">
        </a>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="../../../dist/assets/brand/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="/admin/index">
                <svg class="nav-icon">
                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
        <li class="nav-title">Quản lý</li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> Người Dùng</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{ route('users.show') }}"> Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}"><span
                            class="nav-icon"></span>
                        Thêm người dùng<span class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.permise') }}"><span
                            class="nav-icon"></span>
                        Phân quyền</a></li>
            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-movie"></use>
                </svg> Phim</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="/admin/movie/">Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/movie/create">Thêm phim<span
                            class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use
                        xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-room">
                    </use>
                </svg> Phòng</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="/admin/room/index">Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/room/create">Thêm phòng<span
                            class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-map"></use>
                </svg> Khu vực</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="/admin/area/">Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/area/create">Thêm Khu vực<span
                            class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-building"></use>
                </svg>Rạp Chiếu</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="/admin/cinema/">Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/cinema/create">Thêm Rạp Chiếu Phim<span
                            class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
            </ul>
        </li>
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                </svg> Lịch chiếu</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="/admin/schedule/index">Danh sách</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/schedule/create">Thêm lịch chiếu<span
                            class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
            </ul>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>