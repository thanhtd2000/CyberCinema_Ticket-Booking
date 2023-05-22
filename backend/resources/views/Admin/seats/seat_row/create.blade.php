@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="{{route('admin.seat_row.store')}}" class="container">
            @csrf
            <div class="mb-3">
                <label class="form-label">Seat row</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
        
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
    
         
            
           
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
</div>
   
@endsection