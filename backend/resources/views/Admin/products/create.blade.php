@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('name') }}">
        </div>
        <div class="error">
            @if ($errors->has('name'))
                <span class="text-danger fs-5">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Giá</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="price" value="{{ old('price') }}">
        </div>
        <div class="error">
            @if ($errors->has('price'))
                <span class="text-danger fs-5">
                    {{ $errors->first('price') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số lượng</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="count" value="{{ old('count') }}">
        </div>
        <div class="error">
            @if ($errors->has('count'))
                <span class="text-danger fs-5">
                    {{ $errors->first('count') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image">
        </div>
        <div class="error">
            @if ($errors->has('image'))
                <span class="text-danger fs-5">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mô tả</label>
            <textarea name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        <div class="error">
            @if ($errors->has('description'))
                <span class="text-danger fs-5">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
