@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="{{route('admin.seat_row.update',$seatRow->id)}}" class="container">
            @csrf
            @method('put')
            <div class="mb-3">
                <label class="form-label">Seat Row</label>
                <input type="text" name="name" class="form-control" value="{{$seatRow->name}}">
        
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
         
            
         
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
</div>
   
@endsection