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
                <th scope="col">Release date</th>
                <th scope="col">Tác Giả</th>
                <th scope="col">Diễn Viên</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Trailler</th>
                <th scope="col">Thời Lượng</th>
                <th scope="col">Ngôn Ngữ</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Giá</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Thời gian update</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($areas as $key => $area)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$area->name}}</td>
                <td>
                    <button class="btn btn-primary">
                        <a class="text-white" href="{{route('admin.area.edit', $area->id)}}">Edit</a>
                    </button>
                    <button class="btn btn-danger">
                        <a class="text-white" 
                        onclick="return confirm('Really delete this area?')"
                        href="{{route('admin.area.delete', $area->id)}}"> Delete</a>
                    </button>
                </td>
            </tr>
        @endforeach --}}
        </tbody>
    </table>
@endsection
