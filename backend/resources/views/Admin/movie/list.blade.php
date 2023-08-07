@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <?php
    use App\Helpers\GlobalHelper;
    $globalHelper = new GlobalHelper();
    ?>
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-white" href="{{ route('admin.movie.create') }}">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('admin.movie.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" value="{{ isset($keywords) ? $keywords : '' }}"
                        class="form-control" placeholder="Nhập tên phim">
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>

        </div>
        <button type="button" class="btn btn-danger"><a class="text-white" href="{{ route('admin.movie.trash') }}">Thùng
                Rác</a></button>
    </div>
    <br>
   
    <table class="table border mb-0">
        <thead class="table-light fw-semibold">
            <tr class="align-middle" style="align-items: baseline">
                <th class="text-center">
                    <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                    </svg>
                </th>
               
                <th class="text-center" style="vertical-align: middle;">Tên</th>
                {{-- <th scope="col">Mô tả</th> --}}
                <th class="text-center" style="vertical-align: middle;">Thời gian ra rạp</th>
                <th class="text-center" style="vertical-align: middle;">Tác Giả</th>
                <th class="text-center" style="vertical-align: middle;">Diễn Viên</th>
                <th class="text-center" style="vertical-align: middle;">Danh mục</th>
                <th class="text-center" style="vertical-align: middle;">Thời Lượng</th>
               
                

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $key => $movie)
                <tr class="align-middle">
                    <td class="text-center">
                        <div class="avatar avatar-md"><img class="avatar-img" src="{{ $movie->image }}"
                                alt=""></div>
                    </td>
                    <td class="text-center">
                        <div style="font-weight: bold">{{ $movie->name }}</div>

                    </td>


                    <td class="text-center" style="font-weight: bold">{{ $movie->date }}</td>
                    <td class="text-center" style="font-weight: bold">{{ $movie->director->name }}</td>
                    <td class="text-center" style="font-weight: bold"> @foreach ($movie->actors()->pluck('name')->toArray() as $value)
                        {{ $value . ',' }}
                    @endforeach</td>
                    <td class="text-center" style="font-weight: bold">{{ $movie->category->name }}</td>
                    <td class="text-center" style="font-weight: bold"> {{ $movie->time }}</td>

                    <td>
                        <div class="dropdown">
                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('dist/vendors/@coreui/icons/svg/free.svg#cil-options') }}">
                                    </use>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" style=" min-width: auto;">
                                <a class="dropdown-item btn btn-outline-success" href="{{ route('admin.movie.edit', $movie->id) }}" style=" text-align: center"><i
                                    class="fas fa-pencil-alt"></i></a>
                                <a class="dropdown-item btn btn-outline-danger"   onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="{{ route('admin.movie.delete', ['id' => $movie->id, 'type' => 1]) }}" style=" text-align: center"><i
                                    class="fas fa-trash-alt"></i></a>
                                <a class="dropdown-item movie-detail btn btn-outline-info" data-toggle="modal" data-target="#exampleModalScrollable" data-movie-id="{{ $movie->id }} " style=" text-align: center">Chi tiết</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movie-modal-label"><b>Chi tiết phim</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b>Tên phim:</b>
                    <h4 id="movie-name"></h4>
                    <b>Trailler</b>
                    <p id="movie-trailer"></p>
                    <b>Mô tả</b>
                    <p id="movie-description"></p>
                    <b>Nổi bật</b>
                    <p id="movie-isHot"></p>
                    <b>Thời gian tạo:</b>
                    <p id="movie-created_at"></p>
                    <b>Thời gian cập nhật:</b>
                    <p id="movie-updated_at"></p>
                    <b>Ảnh</b>
                    <br>
                    <img id="movie-image" src="" width="300px" alt="Movie Image">
                </div>
            </div>
        </div>
    </div>

    {{ $movies->links() }}

    <script>
        $(document).ready(function() {
            $('.movie-detail').click(function() {
                var movieId = $(this).data('movie-id');
                $.ajax({
                    url: '/admin/movie/show/' + movieId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var isHotText = response.movie.isHot == 1 ? 'Có' : 'Không';
                        $('#movie-name').text(response.movie.name);
                        $('#movie-trailer').text(response.movie.trailer);
                        $('#movie-description').text(response.movie.description);
                        $('#movie-isHot').text(isHotText);
                        $('#movie-created_at').text(response.movie.created_at);
                        $('#movie-updated_at').text(response.movie.updated_at);
                        $('#movie-image').attr('src', response.movie.image);

                        $('#movie-modal').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
