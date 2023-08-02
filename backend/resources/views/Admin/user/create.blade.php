@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('user.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Người Dùng</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('name') }}"
                aria-describedby="emailHelp">
            @if ($errors->has('name'))
                <span class="text-danger fs-3">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}"
                aria-describedby="emailHelp">
            @if ($errors->has('email'))
                <span class="text-danger fs-3">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" value="{{ old('image') }}"
                aria-describedby="emailHelp">
            @if ($errors->has('image'))
                <span class="text-danger fs-3">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" value="{{ old('password') }}"
                name="password" aria-describedby="emailHelp">
            @if ($errors->has('password'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Reapet Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1"
                name="password_confirmation"value="{{ old('password_confirmation') }}" aria-describedby="emailHelp">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="phone" value="{{ old('phone') }}"
                aria-describedby="emailHelp">
            @if ($errors->has('phone'))
                <span class="text-danger fs-3">
                    {{ $errors->first('phone') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ngày Sinh</label>
            <input type="date" class="form-control" id="exampleInputEmail1" name="birthday"
                value="{{ old('birthday') }}" aria-describedby="emailHelp">
            @if ($errors->has('birthday'))
                <span class="text-danger fs-3">
                    {{ $errors->first('birthday') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Giới Tính</label>
            <select class="form-select" name="sex" aria-label="Default select example">
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
                <option value="3">Khác</option>
            </select>
            @if ($errors->has('sex'))
                <span class="text-danger fs-3">
                    {{ $errors->first('sex') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Vai trò</label>
            <select class="form-select" name="role" aria-label="Default select example">
                <option value="1">Thành viên</option>
                <option value="3">Kiểm Duyệt Viên</option>
            </select>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
