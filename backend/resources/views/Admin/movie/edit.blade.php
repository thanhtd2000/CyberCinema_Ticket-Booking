@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.movie.update', $movie->id) }}" class="container" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Tên Phim</label>
            <input type="text" name="name" class="form-control" value="{{ $movie->name }}">
        </div>
        <div class="error">
            @if ($errors->has('name'))
                <span class="text-danger fs-6">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Mô Tả</label>
            <input type="text" name="description" class="form-control" value="{{ $movie->description }}">
        </div>
        <div class="error">
            @if ($errors->has('description'))
                <span class="text-danger fs-6">
                    {{ $errors->first('description') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ngày ra mắt</label>
            <input type="date" name="date" class="form-control" value="{{ $movie->date }}">
        </div>
        <div class="error">
            @if ($errors->has('date'))
                <span class="text-danger fs-6">
                    {{ $errors->first('date') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Tác Giả</label>
            <select class="js-example-basic-multiple-limit form-control" name="director_id" multiple="multiple">
                @foreach ($directors as $item)
                    <option {{ $movie->director_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
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
            <label class="form-label" style="font-weight:bold">Link Trailer</label>
            <input type="text" name="trailer" class="form-control" value="{{ $movie->trailer }}">
        </div>
        <div class="error">
            @if ($errors->has('trailer'))
                <span class="text-danger fs-6">
                    {{ $errors->first('trailer') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Thời Lượng Phim</label>
            <input type="text" name="time" class="form-control" value="{{ $movie->time }}">
        </div>
        <div class="error">
            @if ($errors->has('time'))
                <span class="text-danger fs-6">
                    {{ $errors->first('time') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ngôn Ngữ</label>
            <input type="text" name="language" class="form-control" value="{{ $movie->language }}">
        </div>
        <div class="error">
            @if ($errors->has('language'))
                <span class="text-danger fs-6">
                    {{ $errors->first('language') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Ảnh</label>
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
            <label class="form-label" style="font-weight:bold">Giá Phim</label>
            <input type="number" name="price" class="form-control" value="{{ $movie->price }}">
        </div>
        <div class="error">
            @if ($errors->has('price'))
                <span class="text-danger fs-6">
                    {{ $errors->first('price') }}
                </span>
            @endif
        </div>
        <div class="mb-3">

            <label for="" style="font-weight:bold">Diễn Viên</label>
            <select class="js-example-basic-hide-search-multi form-control form-select" name="actors[]"
                id="js-example-basic-hide-search-multi" multiple="multiple">
                @foreach ($actors as $item)
                    <option {{ $movie->actors->contains('id', $item->id) ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <label for="" style="font-weight:bold">Thể Loại</label>
        <select class=" form-control form-select" name="category_id">
            @foreach ($categories as $item)
                <option {{ $movie->category_id === $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                    {{ $item->name }}</option>
            @endforeach
        </select>
        <br>
        <div class="mb-3">
            <div class="custom-control custom-switch">

                <input type="checkbox" class="custom-control-input" id="customSwitch1"
                    {{ $movie->isHot == 1 ? 'checked' : '' }} name="isHot" value="1">
                <label class="custom-control-label text-danger" style="font-weight:bold" for="customSwitch1">Nổi
                    bật</label>
            </div>

        </div><br>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Giới hạn từ bao nhiêu tuổi trở lên</label>
            <input type="number" name="year_old" class="form-control" value="{{ $movie->year_old }}">
        </div>
        <div class="error">
            @if ($errors->has('year_old'))
                <span class="text-danger fs-6">
                    {{ $errors->first('year_old') }}
                </span>
            @endif
        </div><br>
        <div class="mb-3">
            <label class="form-label" style="font-weight:bold">Loại Phim (2D hay 3D ...)</label>
            <input type="text" name="type" class="form-control" value="{{ $movie->type }}">
        </div>
        <div class="error">
            @if ($errors->has('type'))
                <span class="text-danger fs-6">
                    {{ $errors->first('type') }}
                </span>
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-outline-primary">Xác nhận</button>
    </form>
    <br>
    @include('Admin.layouts.select2')
@endsection
