@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Area</th>
            <th scope="col">Address</th>
            <th scope="col">
                <button class="btn btn-primary">
                    <a class="text-white" href="{{route('admin.cinema.create')}}">Add</a>
                </button>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cinemas as $key => $cinema)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$cinema->name}}</td>
                <td>{{$cinema->areas->name}}</td>
                <td>{{$cinema->address}}</td>
                <td>
                    <button class="btn btn-primary">
                        <a class="text-white" href="{{route('admin.cinema.edit', $cinema->id)}}">Edit</a>
                    </button>
                    <button class="btn btn-danger">
                        <a class="text-white" 
                        onclick="return confirm('Really delete this area?')"
                        href="{{route('admin.cinema.delete', $cinema->id)}}"> Delete</a>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
