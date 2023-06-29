<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{ route('admin.index') }}">
            <img class="sidebar-brand-full" width="70" src="{{ asset('uploads/logo/logo.png') }}" alt="">
        </a>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="/admin/index">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
        <li class="nav-title">Quản lý</li>

        {{-- Link user view --}}
        @can('list-user')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-user') }}"></use>
                    </svg> Người Dùng</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.show') }}"> Danh sách</a></li>
                    @can('create-user')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.create') }}"><span
                                    class="nav-icon"></span>
                                Thêm người dùng<span class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                    @can('permission')
                        <li class="nav-item"><a class="nav-link" href="{{ route('users.permise') }}"><span
                                    class="nav-icon"></span>
                                Phân quyền </a></li>
                    @endcan
                    @can('permission')
                        <li class="nav-item"><a class="nav-link" href="{{ route('permission.list') }}">Quyền kiểm duyệt viên</a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan
        {{-- Link movie view --}}
        @can('list-movie')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-movie') }}"></use>
                    </svg> Phim</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/movie/">Danh sách</a></li>
                    @can('create-movie')
                        <li class="nav-item"><a class="nav-link" href="/admin/movie/create">Thêm phim<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- Link actor view --}}
        @can('list-actor')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-user') }}">
                        </use>
                    </svg> Diễn viên</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/actor/index">Danh sách</a></li>
                    @can('create-actor')
                        <li class="nav-item"><a class="nav-link" href="/admin/actor/create">Thêm diễn viên<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- Link director view --}}
        @can('list-director')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-smile') }}">
                        </use>
                    </svg> Đạo diễn</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/director/index">Danh sách</a></li>
                    @can('create-director')
                        <li class="nav-item"><a class="nav-link" href="/admin/director/create">Thêm đạo diễn<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- Link category view --}}
        @can('list-category')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-book') }}">
                        </use>
                    </svg> Danh mục phim</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/category/index">Danh sách</a></li>
                    @can('create-category')
                        <li class="nav-item"><a class="nav-link" href="/admin/category/create">Thêm danh mục phim<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan


        {{-- Link room view --}}
        @can('list-room')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-room') }}">
                        </use>
                    </svg> Phòng</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.room') }}">Danh sách</a></li>
                    @can('create-room')
                        <li class="nav-item"><a class="nav-link" href="/admin/room/create">Thêm phòng<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan


        {{-- Link schedule view --}}
        @can('list-schedule')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-calendar') }}"></use>
                    </svg> Lịch chiếu</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/schedule/">Danh sách</a></li>
                    @can('create-schedule')
                        <li class="nav-item"><a class="nav-link" href="/admin/schedule/create">Thêm lịch chiếu<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{-- Link discount view --}}
        @can('list-discount')
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-dollar') }}"></use>
                </svg> Mã giảm giá</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="/admin/discount/">Danh sách</a></li>
                @can('create-discount')
                <li class="nav-item"><a class="nav-link" href="/admin/discount/create">Thêm mã<span
                            class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                @endcan
                
            </ul>
        </li>
        @endcan

        @can('list-seatType')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-sofa') }}"></use>
                    </svg> Ghế</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/seat_type/">Loại ghế</a></li>
                    @can('create-seatType')
                        <li class="nav-item"><a class="nav-link" href="/admin/seat_type/create">Thêm Loại Ghế<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('list-product')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-fastfood') }}"></use>
                    </svg> Sản Phẩm</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/product/">Danh sách</a></li>
                    @can('create-product')
                        <li class="nav-item"><a class="nav-link" href="/admin/product/create">Thêm Mới<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('list-post')
            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-newspaper') }}"></use>
                    </svg>Bài Đăng</a>
                <ul class="nav-group-items">
                    <li class="nav-item"><a class="nav-link" href="/admin/posts/index">Danh sách</a></li>
                    @can('create-post')
                        <li class="nav-item"><a class="nav-link" href="/admin/posts/create">Thêm Mới<span
                                    class="badge badge-sm bg-success ms-auto">ADD</span></a></li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
