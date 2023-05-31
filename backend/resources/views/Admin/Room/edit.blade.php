@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="row">


        <form method="POST" action="{{ route('admin.room.store') }}" class="container">
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
            @foreach( $elements as $element)
                
                @for($j= 1 ; $j<=$room->column ; $j++)
                    <a class="btn btn-outline-dark" style="width: 55px; margin:10px" data-toggle="modal" data-target="#seats">{{ $element.$j}}</a>
                @endfor
                <br>
            @endforeach
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
  
    <div class="modal fade" id="seats" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ghế</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="container">
                    @csrf
                   
                        <div class="mb-3">
                            <label class="form-label">Tên Ghế</label>
                            <input type="text" name="name" class="form-control" value="A1">
        
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Loại ghế</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                                @foreach($seatType as $type)
                                 <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        <div class="mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" name="name" class="form-control" value="">
        
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                  
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
    </div>
@endsection

{{-- @section('js')
    <script>
        $(document).ready(function() {
                $('.row_seat').click(function() {
                    var isChecked = $(this).is(':checked');
                    $(this).closest('.seats').find('.number_seat').toggle(isChecked);
                    $(this).closest('.seats').find('.type_seat').toggle(isChecked);
                });
            });
    </script>
@endsection --}}
