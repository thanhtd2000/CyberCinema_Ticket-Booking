@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <button class="btn btn-primary">
        <a class="text-white" href="{{ route('admin.movie.create') }}">Add</a>
    </button>

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
                    <td>{{ $movie->description }}</td>
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
                                href="{{ route('admin.movie.edit', $movie->id) }}">Sửa</a></button>
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="{{ route('admin.movie.delete', $movie->id) }}">Xoá</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $movies->links() }}
@endsection
