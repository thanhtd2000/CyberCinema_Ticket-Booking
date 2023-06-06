@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.schedule.store') }}" class="container">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlSelect1">Phim</label>
            <select class="js-example-basic-multiple-limit form-control" name="movie_id">
                @foreach ($movies as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>

            @error('movie_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Phòng</label>
            <select class="js-example-basic-multiple-limit form-control type" name="room_id" id="type">
                <option value="0">Chọn phòng</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>

            @error('room_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Thời gian chiếu</label>
            <input type="datetime-local" name="time_start" class="form-control" value="{{ old('time-start') }}">
        </div>

        <button type="submit" class="btn btn-outline-primary">Thêm mới</button>
    </form>

    @include('Admin.layouts.select2')
@endsection
