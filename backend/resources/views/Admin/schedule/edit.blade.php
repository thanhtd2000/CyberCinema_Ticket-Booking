@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{ route('admin.schedule.update', ['id' => $schedule->id]) }}" class="container">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="exampleFormControlSelect1">Phim</label>
            <select class="js-example-basic-multiple-limit form-control" name="movie_id" multiple="multiple">
                @foreach ($movies as $item)
                    <option {{ $schedule->movie_id === $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                        {{ $item->name }}</option>
                @endforeach
            </select>

            @error('movie_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Phòng</label>
            <select class="js-example-basic-multiple-limit form-control type" name="room_id" id="type"
                multiple="multiple">
                <option value="0">Chọn phòng</option>
                @foreach ($rooms as $room)
                    <option {{ $schedule->room_id === $room->id ? 'selected' : '' }} value="{{ $room->id }}">
                        {{ $room->name }}</option>
                @endforeach
            </select>

            @error('room_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Thời gian chiếu</label>
            <input type="datetime-local" name="time_start" class="form-control" value="{{ $schedule->time_start }}">
        </div>

        <button type="submit" class="btn btn-outline-primary">Cập nhật</button>
    </form>

    @include('Admin.layouts.select2')
@endsection
