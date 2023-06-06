@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('users.change_passwords') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="exampleInputPassword1" value="{{ old('password') }}"
                name="password" aria-describedby="emailHelp">
            @if ($errors->has('password'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="exampleInputPassword1" value="{{ old('password_confirmation') }}"
                name="password_confirmation" aria-describedby="emailHelp">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Thay Đổi</button>
    </form>
@endsection
