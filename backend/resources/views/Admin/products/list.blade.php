@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-white" href="{{ route('admin.product.create') }}">Thêm mới</a></button>
        <div class="row align-items-center">
            <form action="{{ route('admin.product.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th class="">STT</th>
                <th class="">Ảnh</th>
                <th class="">Tên sản phẩm</th>
                <th class="">Giá</th>
                <th class="">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td class="">{{ $key += 1 }}</td>
                    <td><img src="{{ $product->image }}" width="50px" alt=""></td>
                    <td class="">{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.product.edit', $product->id) }}"><i
                                    class="fas fa-pencil-alt"></i></a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this product?')"
                                href="{{ route('admin.product.delete', $product->id) }}"><i
                                    class="fas fa-trash-alt"></i></a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
