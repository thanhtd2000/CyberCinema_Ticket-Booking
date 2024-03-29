@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form action="{{ route('admin.discount.update', $discount->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" style="font-weight:bold">Mã giảm giá</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="code" value="{{ $discount->code }}">
        </div>
        <div class="error">
            @if ($errors->has('code'))
                <span class="text-danger fs-5">
                    {{ $errors->first('code') }}
                </span>
            @endif
        </div>


        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label" style="font-weight:bold">Số lượng</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="count"
                value="{{ $discount->count }}">
        </div>
        <div class="error">
            @if ($errors->has('count'))
                <span class="text-danger fs-5">
                    {{ $errors->first('count') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ngày áp dụng</label>
            <input type="date" name="start_time" class="form-control" value="{{ $discount->start_time }}">
        </div>
        <div class="error">
            @if ($errors->has('start_time'))
                <span class="text-danger fs-5">
                    {{ $errors->first('start_time') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ngày kết thúc</label>
            <input type="date" name="end_time" class="form-control" value="{{ $discount->end_time }}">
        </div>
        <div class="error">
            @if ($errors->has('end_time'))
                <span class="text-danger fs-5">
                    {{ $errors->first('end_time') }}
                </span>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Phần trăm triết khấu</label>
            <input type="number" name="percent" class="form-control" value="{{ $discount->percent }}">
        </div>
        <div class="error">
            @if ($errors->has('percent'))
                <span class="text-danger fs-5">
                    {{ $errors->first('percent') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Mô tả</label>
            <input class="form-control" type="text" name="description" value="{{ $discount->description }}">

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
