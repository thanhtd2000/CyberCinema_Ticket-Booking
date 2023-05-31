@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<div class="row">
   
    
    <form method="POST" action="{{route('admin.room.store')}}" class="container">
        @csrf
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Tên phòng</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
        
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>        
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Số hàng</label>
                <input type="number" name="row" class="form-control" value="{{old('row')}}">
        
                @error('row')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>        
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Số cột</label>
                <input type="number" name="column" class="form-control" value="{{old('column')}}">
        
                @error('column')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>        
        </div>
       
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
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