@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')

<button class="btn btn-primary">
    <a class="text-white" href="">Add</a>
</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            
            <th scope="col">Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($seatRows as $key => $seatRow)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$seatRow->name}}</td>
               
               
                <td>
                    {{-- <a class="btn btn-success" href="{{route('admin.seat_type.edit', $seatType->id)}}"><i class="fas fa-pencil-alt"></i> </a> --}}
                    <a class="btn btn-danger"   OnClick='return confirm("Are you want to delete ?");' href=""><i class="fas fa-trash-alt"></i> </a>
                  
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
