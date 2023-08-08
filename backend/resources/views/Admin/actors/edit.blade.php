@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.actor.update', $actor->id) }}" class="container" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Tên diễn viên</label>
            <input type="text" name="name" class="form-control" value="{{ $actor->name }}">

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ngày sinh</label>
            <input type="date" name="birthday" class="form-control" value="{{ $actor->birthday }}">

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
        <img src="{{ $actor->image }}" alt="" width="50">

        <label class="form-label" style="font-weight:bold">Giới tính</label>
        <div class="form-floating">
            <select class="form-select" name="gender" id="floatingSelect" aria-label="Floating label select example">
                <option value="1" {{ $actor->gender == 1 ? 'selected' : '' }}>Nam</option>
                <option value="2" {{ $actor->gender == 2 ? 'selected' : '' }}>Nữ</option>
                <option value="3" {{ $actor->gender == 3 ? 'selected' : '' }}>Khác</option>
            </select>

            @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Quốc tịch</label>
            <input type="text" name="nationality" class="form-control" value="{{ $actor->nationality }}">

            @error('nationality')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
    </form>
@endsection
