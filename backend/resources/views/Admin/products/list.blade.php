@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-white" href="{{ route('admin.product.create') }}">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('admin.product.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="button" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="col">STT</th>
                <th class="col">Tên sản phẩm</th>
                <th class="col">Giá</th>
                <th class="col">Ảnh</th>
                <th class="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td class="col">{{ $key += 1 }}</td>
                    <td class="col">{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                    <td><img src="{{ $product->image }}" width="100px" alt=""></td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.product.edit', $product->id) }}">Edit</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this product?')"
                                href="{{ route('admin.product.delete', $product->id) }}"> Delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
