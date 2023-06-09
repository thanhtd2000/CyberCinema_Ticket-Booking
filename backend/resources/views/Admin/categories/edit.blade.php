@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.category.update', $category->id) }}" class="container">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">

            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
    </form>
@endsection
