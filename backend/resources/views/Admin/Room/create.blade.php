@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<div class="row">
   
    
    <form method="POST" action="{{route('admin.seat_type.store')}}" class="container">
        @csrf
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Tên phòng</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
        
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn rạp</label>
                <select class="form-control" name="cinemas">
                    <option value="">Chọn rạp chiếu</option>
                    @foreach($cinemas as $cinema)
                    <option value="{{$cinema->id}}">{{$cinema->name}}</option>
                    @endforeach
                </select>
        
                @error('cinemas')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <label class="form-label">Chọn hàng</label>
            @foreach ($seatRows as $seatRow)
                <div class="col-md-4 seats" style="padding-left: 40px">
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input row_seat" name="seat_row[]" type="checkbox" id="inlineCheckbox2" value="{{$seatRow->id }}">
                            <label class="form-check-label" for="inlineCheckbox2">Hàng {{ $seatRow->name }}</label>
                        </div>
                        <div class="mb-3 number_seat" style="display: none">
                            <label class="form-label">Số ghế </label>
                            <input type="number" name="number_seat[]" class="form-control " value="{{old('name')}}">
                    
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                      @foreach ($seatTypes as $seatType)
                        <div class="form-check form-check-inline type_seat" style="display: none">
                            <input class="form-check-input " type="radio" name="seat_type[]" id="inlineRadio2" value="{{$seatType->id}}">
                            <label class="form-check-label" for="inlineRadio2">{{ $seatType->name }}</label>
                        </div>
            
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                      @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
</div>
   
@endsection

@section('js')
    <script>
        $(document).ready(function() {
                $('.row_seat').click(function() {
                    var isChecked = $(this).is(':checked');
                    $(this).closest('.seats').find('.number_seat').toggle(isChecked);
                    $(this).closest('.seats').find('.type_seat').toggle(isChecked);
                });
            });
    </script>
@endsection