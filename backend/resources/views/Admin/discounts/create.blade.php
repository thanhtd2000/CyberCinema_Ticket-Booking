@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form action="{{ route('admin.discount.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mã giảm giá</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="code" value="{{ old('code') }}">
        </div>
        <div class="error">
            @if ($errors->has('code'))
                <span class="text-danger fs-5">
                    {{ $errors->first('code') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tiền tối thiểu</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="min_price"
                value="{{ old('min_price') }}">
        </div>
        <div class="error">
            @if ($errors->has('min_price'))
                <span class="text-danger fs-5">
                    {{ $errors->first('min_price') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tiền tối đa</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="max_price"
                value="{{ old('max_price') }}">
        </div>
        <div class="error">
            @if ($errors->has('max_price'))
                <span class="text-danger fs-5">
                    {{ $errors->first('max_price') }}
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
            <label class="form-label">Ngày áp dụng</label>
            <input type="date" name="start_time" class="form-control" value="{{ old('start_time') }}">
        </div>
        <div class="error">
            @if ($errors->has('start_time'))
                <span class="text-danger fs-5">
                    {{ $errors->first('start_time') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày kết thúc</label>
            <input type="date" name="end_time" class="form-control" value="{{ old('end_time') }}">
        </div>
        <div class="error">
            @if ($errors->has('end_time'))
                <span class="text-danger fs-5">
                    {{ $errors->first('end_time') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Phần trăm triết khấu</label>
            <input type="number" name="percent" class="form-control" value="{{ old('percent') }}">
        </div>
        <div class="error">
            @if ($errors->has('percent'))
                <span class="text-danger fs-5">
                    {{ $errors->first('percent') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Loại áp dụng</label>
            <select name="role" id="">
                <option hidden>Chọn phân loại</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        <div class="error">
            @if ($errors->has('role'))
                <span class="text-danger fs-5">
                    {{ $errors->first('role') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Triết khấu giới hạn</label>
            <input type="number" name="discount_limit" class="form-control" value="{{ old('discount_limit') }}">
        </div>
        <div class="error">
            @if ($errors->has('discount_limit'))
                <span class="text-danger fs-5">
                    {{ $errors->first('discount_limit') }}
                </span>
            @endif
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
