@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <form method="POST" action="{{route('admin.cinema.store')}}" class="container">
        @csrf
        <div class="mb-3">
            <label class="form-label">Cinema Name</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
    
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <label class="form-label">Area</label>
        <div class="form-floating">
            <select class="form-select" name="area_id" id="floatingSelect" aria-label="Floating label select example">
                @foreach ($areas as $area)
                    <option value="{{$area->id}}">{{$area->name}}</option>
                @endforeach
            </select>

            @error('area_id')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{old('address')}}">
    
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-outline-primary">Submit</button>
    </form>
@endsection