@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')


<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên phòng</th>
            <th scope="col">Số ghế</th>
            <th scope="col">Số ghế đơn</th>
            <th scope="col">Số ghế VIP</th>
            <th scope="col">Số ghế đôi</th> 
            <th scope="col">Action</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($rooms as $key => $room)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$room->name}}</td>
                <td>{{count($room->seats->where('status',0))}}</td>
                <td>{{count($room->seats->where('type_id',1)->where('status',0))}}</td>
                <td>{{count($room->seats->where('type_id',2)->where('status',0))}}</td>
                <td>{{count($room->seats->where('type_id',3)->where('status',0))}}</td>

                <td>
                    <a class="text-white btn btn-success " onclick=" return confirm('Bạn có chắc chắn khôi phục?')" href="{{ route('admin.room.restore', $room->id) }}"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-danger" onclick=" return confirm('Bạn có chắc chắn xoá vĩnh viễn ?')" href="{{ route('admin.room.delete', ['id' => $room->id, 'type' => 2]) }}"><i class="fas fa-trash-alt"></i></a>
                  
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
