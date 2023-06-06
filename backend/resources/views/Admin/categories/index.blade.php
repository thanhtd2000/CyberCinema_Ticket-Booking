@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-primary col-md-1"><a class="text-white" href="{{ route('admin.category.create') }}">Thêm mới</a></button>
        <div class="row g-3 align-items-center col-md-4">
            <form action="{{ route('admin.category.search') }}" method="POST" class="d-flex">
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
                <th scope="col">Tên danh mục</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.category.edit', $category->id) }}">Sửa</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this category?')"
                                href="{{ route('admin.category.destroy', $category->id) }}"> Xóa</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection
