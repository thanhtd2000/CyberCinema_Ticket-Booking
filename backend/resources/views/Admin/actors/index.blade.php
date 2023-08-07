@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        @can('create-actor')
        <button type="button" class="btn btn-primary col-md-1"><a class="text-white" href="{{ route('admin.actor.create') }}">Thêm mới</a></button>
        @endcan
        <div class="row g-3 align-items-center col-md-4">
            <form action="{{ route('admin.actor.search') }}" method="POST" class="d-flex">
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
                <th scope="col">Tên diễn viên</th>
                <th scope="col">Ngày Sinh</th>
                <th scope="col">Quốc tịch</th>
                <th scope="col">Giới tính</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actors as $key => $actor)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td><img src="{{ $actor->image }}" alt="" width="50"></td>
                    <td style="font-weight: bold">{{ $actor->name }}</td>
                    <td style="font-weight: bold">{{ date('d/m/Y', strtotime($actor->birthday)) }}</td>
                    <td style="font-weight: bold">{{ $actor->nationality }}</td>
                    <td style="font-weight: bold">{{ $actor->gender == 1 ? 'Nam' : ($actor->gender == 2 ? 'Nữ' : 'Khác') }}</td>
                    <td>
                        @can('edit-actor')
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.actor.edit', $actor->id) }}">Sửa</a>
                        </button>
                        @endcan
                        @can('delete-actor')
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this actor?')"
                                href="{{ route('admin.actor.destroy', $actor->id) }}"> Xóa</a>
                        </button>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $actors->links() }}
@endsection
