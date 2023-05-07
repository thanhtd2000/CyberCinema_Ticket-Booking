@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">
                <button class="btn btn-primary">
                    <a class="text-white" href="{{route('admin.area.create')}}">Add</a>
                </button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($areas as $key => $area)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$area->name}}</td>
                <td>
                    <button class="btn btn-primary">
                        <a class="text-white" href="{{route('admin.area.edit', $area->id)}}">Edit</a>
                    </button>
                    <button class="btn btn-danger">
                        <a class="text-white" 
                        onclick="return confirm('Really delete this area?')"
                        href="{{route('admin.area.delete', $area->id)}}"> Delete</a>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
