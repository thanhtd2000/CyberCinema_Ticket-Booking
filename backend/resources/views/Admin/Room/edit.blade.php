@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="row">


        <form method="POST" action="{{ route('admin.room.update',['id'=>$room->id]) }}" class="container">
            @csrf
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tên phòng</label>
                    <input type="text" name="name" class="form-control" value="{{ $room->name }}">

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


            </div>

            {{-- @foreach ($seats as $seat)
                <a @if ($seat->type_id == 1) class="btn btn-success" @elseif($seat->type_id == 2) class="btn btn-primary" @elseif($seat->type_id == 3) class="btn btn-danger" @endif style="width: 55px; margin:10px" data-toggle="modal"data-target="#seats">{{ $seat->name}}</a>
                @if (count($seats) == $room->column)
                  <br>
                @endif

            @endforeach --}}
            @foreach ($elements as $element)
                @for ($j = 1; $j <= $room->column; $j++)
                    @if (
                        $seats->contains(function ($t) use ($element, $j) {
                            return $t->name == $element . $j;
                        }))
                        @php
                            $seat = $seats->first(function ($t) use ($element, $j) {
                                return $t->name == $element . $j;
                            });
                        @endphp
                        @if ($seat->status == 0)
                            <a @if ($seat->type_id == 1) class="btn btn-success seat-detail"
                            @elseif ($seat->type_id == 2) class="btn btn-primary seat-detail"
                            @elseif ($seat->type_id == 3) class="btn btn-danger seat-detail" @endif
                                style="width: 55px; margin:10px" data-toggle="modal" data-target="#seats"
                                data-seat-id="{{ $seat->id }}">
                                {{ $element . $j }}
                            </a>
                        @elseif ($seat->status == 1)
                            <a class="btn btn-outline-dark seat-detail" style="width: 55px; margin:10px" data-toggle="modal"
                                data-target="#seats" data-seat-id="{{ $seat->id }}">{{ $element . $j }}</a>
                        @endif
                    @endif
                @endfor
                <br>
            @endforeach
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>

    <div class="modal fade" id="seats" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ghế</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form method="POST" action="" class="container">
                        @csrf --}}

                    <div class="mb-3">
                        <label class="form-label">Tên Ghế</label>
                        <input type="hidden" id="seat-id" value="">
                        <input type="text" name="name" class="form-control name" id="name" value=""
                            readonly>

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Loại ghế</label>
                        <select class="form-control type" id="type">
                            @foreach ($seatType as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Trạng thái</label>
                        <select class="form-control type" id="status">
                           
                                <option value="0">Sử dụng </option>
                                <option value="1"> Không sử dụng </option>
                            
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary save-seat">Lưu </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //    $(document).on("click", ".seat", function(e) {
        //     e.preventDefault();
        //     var seat_id = $(this).data('seat-id');

        //     $.ajax({
        //         url: 'admin/seats/edit/' + seat_id,
        //         method: 'GET',
        //         success: function(data) {
        //             var seatData = data;
        //             showModal(seatData)
        //         }
        //     })
        //    });
        //    function showModal(seatData){
        //       $('.name').val(seatData.name);
        //       $('.type').val(seatData.type_id);

        //       $('#seats').modal('show');
        //    }

        $(document).on('click', '.seat-detail', function(e) {
            var seat_id = $(this).data('seat-id');
            // console.log(seat_id);
            $('#seats').modal('show');
            $.ajax({
                url: '/admin/seats/edit/' + seat_id,
                type: 'GET',
                success: function(response) {

                    $('#seat-id').val(response.seat.id);
                    $('#name').val(response.seat.name);
                    $('#type').val(response.seat.type_id);
                    $('#status').val(response.seat.status);



                }
            });
        });


        $(document).on('click', '.save-seat', function(e) {
            e.preventDefault();
            var seat_id = $('#seat-id').val();
            var data = {
                'type_id': $('#type').val(),
                'status' : $('#status').val()
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/seats/update/' + seat_id,
                type: 'PUT',
                data: data,
                // dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: 'Cập nhật dữ liệu thành công.',
                        showConfirmButton: false,
                        timer: 1000,
                        timerProgressBar: true
                    }).then(function() {
                        // Sau khi popup đóng, load lại trang
                        location.reload();
                    });


                }
            });
        })
    </script>
@endsection
