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
        </div><button type="button" class="btn btn-primary"><a class="text-danger" href="{{ route('admin.movie') }}">Kho
                Phim</a></button>
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
                <th scope="col">Trailer</th>
                <th scope="col">Thời Lượng</th>
                <th scope="col">Ngôn Ngữ</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Slug</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Thời gian update</th>
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
                    <td>{{ $movie->trailer }}</td>
                    <td>{{ $movie->time }}</td>
                    <td>{{ $movie->language }}</td>
                    <td><img src="{{ $movie->image }}" alt="" width="100"></td>
                    <td>{{ $movie->price }}</td>
                    <td>{{ $movie->slug }}</td>
                    <td>{{ $movie->created_at }}</td>
                    <td>{{ $movie->updated_at }}</td>
                    <td><button type="button" class="btn btn-success"><a
                                onclick=" return confirm('Bạn có chắc chắn khôi phục?')"
                                href="{{ route('admin.movie.restore', $movie->id) }}">Khôi Phục</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $movies->appends(request()->all())->links() }}
@endsection
