@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.director.store') }}" class="container" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Tên đạo diễn</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ngày sinh</label>
            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">

            @error('birthday')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ảnh</label>
            <input type="file" name="image" class="form-control">

            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <label class="form-label" style="font-weight:bold">Giới tính</label>
        <div class="form-floating">
            <select class="form-select" name="gender" id="floatingSelect" aria-label="Floating label select example">
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
                <option value="3">Khác</option>
            </select>

            @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
        <label class="form-label" style="font-weight:bold">Quốc tịch</label>
            <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}">

            @error('nationality')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">Thêm</button>
    </form>
@endsection
