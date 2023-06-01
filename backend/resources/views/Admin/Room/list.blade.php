@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')

<button class="btn btn-primary">
    <a class="text-white" href="{{route('admin.room.create')}}">Thêm</a>
</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên phòng</th>
            <th scope="col">Số ghế</th>
            {{-- <th scope="col">Số ghế VIP</th>
            <th scope="col">Số ghế đôi</th> --}}
            <th scope="col">Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($rooms as $key => $room)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$room->name}}</td>
               
                <td>{{$room->row*$room->column}}</td>
                <td>
                    <a class="btn btn-success" href="{{route('admin.room.edit', $room->id)}}"><i class="fas fa-pencil-alt"></i> </a>
                    <a class="btn btn-danger"   OnClick='return confirm("Are you want to delete ?");' href="{{route('admin.room.delete', $room->id)}}"><i class="fas fa-trash-alt"></i> </a>
                  
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
