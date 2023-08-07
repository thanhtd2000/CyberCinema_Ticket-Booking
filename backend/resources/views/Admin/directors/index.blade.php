@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-primary col-md-1"><a class="text-white" href="{{ route('admin.director.create') }}">Thêm mới</a></button>
        <div class="row g-3 align-items-center col-md-4">
            <form action="{{ route('admin.director.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" value="{{ isset($keywords) ? $keywords : '' }}"
                        class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên đạo diễn</th>
                <th scope="col">Ngày sinh</th>
                <th scope="col">Quốc tịch</th>
                <th scope="col">Giới tính</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($directors as $key => $director)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td><img src="{{ $director->image }}" alt="" width="50"></td>
                    <td style="font-weight: bold">{{ $director->name }}</td>
                    <td style="font-weight: bold">{{ date('d/m/Y', strtotime($director->birthday)) }}</td>
                    <td style="font-weight: bold">{{ $director->nationality }}</td>
                    <td style="font-weight: bold">{{ $director->gender == 1 ? 'Nam' : ($director->gender == 2 ? 'Nữ' : 'Khác') }}</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.director.edit', $director->id) }}">Sửa</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this director?')"
                                href="{{ route('admin.director.destroy', $director->id) }}"> Xóa</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $directors->links() }}
@endsection
