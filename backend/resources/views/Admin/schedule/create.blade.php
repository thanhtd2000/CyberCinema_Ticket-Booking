@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex">
        <div class="col-md-6">
            <h3>Thêm lịch</h3>
            <form method="POST" action="{{ route('admin.schedule.store') }}" class="container">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="font-weight:bold">Phim</label>
                    <select class="js-example-basic-multiple-limit form-control" name="movie_id" multiple="multiple">
                        {{-- <option value="">Chọn phim</option> --}}
                        @foreach ($movies as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('movie_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1" style="font-weight:bold">Phòng</label>
                    <select class="js-example-basic-multiple-limit form-control type" name="room_id" id="type"
                        multiple="multiple">
                        {{-- <option value="">Chọn phòng</option> --}}
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>

                    @error('room_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div id="additionalDates">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1" style="font-weight:bold">Ngày chiếu</label>
                        <button type="button" class="btn btn-outline-success" style="font-size: 15px; margin: 10px;"
                            id="addDateBtn"><i class="fas fa-plus"></i></button>
                        <input type="datetime-local" name="time_start[]" class="form-control"
                            value="{{ old('time_start') }}">
                    </div>
                </div>


                <button type="submit" class="btn btn-outline-primary">Thêm mới</button>
            </form>
        </div>
        <div class="mt-2 col-md-6">
            <h3>Kiểm tra lịch tồn tại</h3>
            <form action="" class="" style="align-items: baseline">
                <label for="" style="font-weight:bold">Ngày muốn kiểm tra</label>
                <input type="date" name="keydate" id="date" class="form-control" value="">
                <br>

                <label for="exampleFormControlSelect1" style="font-weight:bold">Phòng</label>
                <select class="js-example-basic-multiple-limit form-control type" name="room_id" id="room_id"
                    multiple="multiple">
                    {{-- <option value="">Chọn phòng</option> --}}
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                </select>

                @error('room_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <br>
                <button type="button" class="btn btn-primary total-search mt-3" id="">Kiểm tra</button>
            </form>
            <br>
            <div>
                <h5>Hiện đang có những khung giờ này đã được sử dụng : </h5>
                <ul id="time-list">
                </ul>
            </div>
        </div>
    </div>
    @include('Admin.layouts.select2')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var counter = 1;

            $('#addDateBtn').click(function() {
                var html = '<div class="form-group">' +
                    '<label for="exampleFormControlSelect1">Ngày chiếu</label>' +
                    '<input type="datetime-local" name="time_start[]" class="form-control" value="{{ old('time_start') }}">' +
                    '</div>';

                $('#additionalDates').append(html);
                counter++;
            });
        });
    </script>
    <script>
        $(document).on('click', '.total-search', function(e) {
            $("#time-list").empty();
            var date = $("#date").val();
            var room_id = $("#room_id").val();
            $.ajax({
                url: '/admin/checktime',
                type: 'GET',
                data: {
                    date: date,
                    room_id: room_id,
                },
                dataType: 'json',
                success: function(data) {
                    var timeList = $("#time-list");
                    if (data.length === 0) {
                        timeList.html("<p>Không có lịch cho ngày và phòng đã chọn.</p>");
                    } else {
                        $.each(data, function(index, item) {
                            timeList.append("<li>" + item.time_start + " đến " + item.time_end + "</li>");
                        });
                    }
                },
                error: function(error) {
                    console.error('Error while fetching data:', error);
                }
            });
        });
    </script>
@endsection
