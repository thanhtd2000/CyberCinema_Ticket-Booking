@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')

<button class="btn btn-primary mb-3">
    <a class="text-white" href="{{route('admin.room.create')}}">Thêm</a>
</button>
<button type="button" class="btn btn-danger" style="float:right"><a class="text-white"
    href="{{ route('admin.room.trash') }}">Thùng Rác</a></button>
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
                <td style="font-weight: bold">{{$room->name}}</td>
                <td style="font-weight: bold">{{count($room->seats->where('status',0))}}</td>
                <td style="font-weight: bold">{{count($room->seats->where('type_id',1)->where('status',0))}}</td>
                <td style="font-weight: bold">{{count($room->seats->where('type_id',2)->where('status',0))}}</td>
                <td style="font-weight: bold">{{count($room->seats->where('type_id',3)->where('status',0))}}</td>

                <td >
                    {{-- {{dd($schedule->where('room_id',$room->id) )}} --}}
                   
                    <a class="btn btn-success" href="{{route('admin.room.edit', $room->id)}}"><i class="fas fa-pencil-alt"></i> </a>
                    <a class="btn btn-danger"   OnClick='return confirm("Bạn có muốn bỏ vào thùng rác ?");' href="{{route('admin.room.delete', $room->id)}}"><i class="fas fa-trash-alt"></i> </a>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
