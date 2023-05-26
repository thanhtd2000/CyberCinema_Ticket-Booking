@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-danger" href="{{ route('admin.movie.create') }}">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('admin.movie.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" value="{{ isset($keywords) ? $keywords : '' }}"
                        class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="submit" class="btn btn-primary text-black ms-3">Tìm kiếm</button>
            </form>

        </div><button type="button" class="btn btn-primary"><a class="text-danger"
                href="{{ route('admin.movie.trash') }}">Thùng Rác</a></button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Mô tả</th>
                <th scope="col">Thời gian ra rạp</th>
                <th scope="col">Tác Giả</th>
                <th scope="col">Diễn Viên</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Thời Lượng</th>
                <th scope="col">Ngôn Ngữ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $key => $movie)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $movie->name }}</td>
                    <td
                        style="display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;">
                        {{ $movie->description }}</td>
                    <td>{{ $movie->date }}</td>
                    <td>{{ $movie->director->name }}</td>
                    <td>
                        @foreach ($movie->actors()->pluck('name')->toArray() as $value)
                            {{ $value . ',' }}
                        @endforeach
                    </td>
                    <td>{{ $movie->category->name }}</td>
                    <td>{{ $movie->time }}</td>
                    <td>{{ $movie->language }}</td>
                    <td><button type="button" class="btn btn-success"><a
                                href="{{ route('admin.movie.edit', $movie->id) }}">Sửa</a></button>
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="{{ route('admin.movie.delete', $movie->id) }}">Xoá</a></button>

                    </td>
                    <td> <button class="btn btn-primary movie-detail" data-movie-id="{{ $movie->id }} ">Xem chi
                            tiết</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="movie-modal" tabindex="-1" role="dialog" aria-labelledby="movie-modal-label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movie-modal-label"><b>Chi tiết phim</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b>Tên phim:</b>
                    <h3 id="movie-name"></h3>
                    <b>Trailler</b>
                    <p id="movie-trailer"></p>
                    <b>Is Hot</b>
                    <p id="movie-isHot"></p>
                    <b>Thời gian tạo:</b>
                    <p id="movie-created_at"></p>
                    <b>Thời gian cập nhật:</b>
                    <p id="movie-updated_at"></p>
                    <b>Ảnh</b>
                    <img id="movie-image" src="" width="300px" alt="Movie Image">
                </div>
            </div>
        </div>
    </div>

    {{ $movies->appends(request()->all())->links() }}

    <script>
        $(document).ready(function() {
            $('.movie-detail').click(function() {
                var movieId = $(this).data('movie-id');

                $.ajax({
                    url: '/admin/movie/show/' + movieId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.movie);
                        $('#movie-name').text(response.movie.name);
                        $('#movie-trailer').text(response.movie.trailer);
                        $('#movie-isHot').text(response.movie.isHot);
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
