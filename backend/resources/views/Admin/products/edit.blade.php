@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" class="container"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp"
                value="{{ $product->name }}">
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
            <input type="number" class="form-control" id="exampleInputEmail1" name="price" aria-describedby="emailHelp"
                value="{{ $product->price }}">
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
            <input type="number" class="form-control" id="exampleInputEmail1" name="count" aria-describedby="emailHelp"
                value="{{ $product->count }}">
        </div>
        <div class="error">
            @if ($errors->has('count'))
                <span class="text-danger fs-5">
                    {{ $errors->first('count') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
            <img src="{{ $product->image }}" width="100" alt="">
        </div>
        <div class="error">
            @if ($errors->has('image'))
                <span class="text-danger fs-6">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mô tả</label>
            <textarea name="description" id="" cols="30" rows="10">{{ $product->description }}</textarea>
        </div>
        <div class="error">
            @if ($errors->has('description'))
                <span class="text-danger fs-5">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
