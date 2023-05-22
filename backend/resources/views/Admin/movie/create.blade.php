@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.movie.store') }}" class="container" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên Phim</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="error">
            @if ($errors->has('name'))
                <span class="text-danger fs-6">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Mô Tả</label>
            <input type="text" name="description" class="form-control" value="{{ old('description') }}">
        </div>
        <div class="error">
            @if ($errors->has('description'))
                <span class="text-danger fs-6">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Ngày ra mắt</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
        </div>
        <div class="error">
            @if ($errors->has('date'))
                <span class="text-danger fs-6">
                    {{ $errors->first('date') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Tác Giả</label>
            <select class="js-example-basic-multiple-limit form-control" name="director_id" multiple="multiple">
                @foreach ($directors as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="error">
            @if ($errors->has('director_id'))
                <span class="text-danger fs-6">
                    {{ $errors->first('director_id') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Link Trailer</label>
            <input type="text" name="trailer" class="form-control" value="{{ old('trailer') }}">
        </div>
        <div class="error">
            @if ($errors->has('trailer'))
                <span class="text-danger fs-6">
                    {{ $errors->first('trailer') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Thời Lượng Phim</label>
            <input type="time" name="time" class="form-control" value="{{ old('time') }}">
        </div>
        <div class="error">
            @if ($errors->has('time'))
                <span class="text-danger fs-6">
                    {{ $errors->first('time') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Ngôn Ngữ</label>
            <input type="text" name="language" class="form-control" value="{{ old('language') }}">
        </div>
        <div class="error">
            @if ($errors->has('language'))
                <span class="text-danger fs-6">
                    {{ $errors->first('language') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Ảnh</label>
            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
        </div>
        <div class="error">
            @if ($errors->has('image'))
                <span class="text-danger fs-6">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Giá Phim</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="error">
            @if ($errors->has('price'))
                <span class="text-danger fs-6">
                    {{ $errors->first('price') }}
                </span>
            @endif
        </div>
        <label for="">Diễn Viên</label>
        <select class="js-example-basic-hide-search-multi form-control form-select" name="actors[]"
            id="js-example-basic-hide-search-multi" multiple="multiple">
            @foreach ($actors as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="">Thể Loại</label>
        <select class=" form-control form-select" name="category_id">
            @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit" class="btn btn-outline-primary">Xác nhận</button>
    </form>

    @include('Admin.layouts.select2')
@endsection
