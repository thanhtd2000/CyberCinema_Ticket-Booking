@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user['id'] }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Người Dùng</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $user['name'] }}"
                aria-describedby="emailHelp">
            @if ($errors->has('name'))
                <span class="text-danger fs-3">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="{{ $user['email'] }}"
                aria-describedby="emailHelp">
            @if ($errors->has('email'))
                <span class="text-danger fs-3">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="exampleInputEmail1" value="{{ old('password') }}"
                name="password" aria-describedby="emailHelp">
            @if ($errors->has('password'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="exampleInputEmail1" name="password_confirmation"
                aria-describedby="emailHelp">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
            <input type="number" class="form-control" id="exampleInputEmail1" name="phone" value="{{ $user['phone'] }}"
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
                value="{{ $user['birthday'] }}" aria-describedby="emailHelp">
            @if ($errors->has('birthday'))
                <span class="text-danger fs-3">
                    {{ $errors->first('birthday') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Giới Tính</label>
            <select class="form-select" name="sex" aria-label="Default select example">
                <option value="1" {{ $user->sex == 1 ? 'selected' : '' }}>Nam</option>
                <option value="2" {{ $user->sex == 2 ? 'selected' : '' }}>Nữ</option>
                <option value="3" {{ $user->sex == 3 ? 'selected' : '' }}>Khác</option>
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
                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Thành viên</option>
                <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Kiểm Duyệt Viên</option>
            </select>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
