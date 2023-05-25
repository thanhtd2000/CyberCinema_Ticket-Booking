@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')

<button class="btn btn-primary">
    <a class="text-white" href="{{route('admin.room.create')}}">Add</a>
</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên phòng</th>
            <th scope="col">Tên rạp</th>
            <th scope="col">Số ghế đơn</th>
            <th scope="col">Số ghế VIP</th>
            <th scope="col">Số ghế đôi</th>
            <th scope="col">Action</th>
            
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($seatTypes as $key => $seatType)
            <tr>
                <th scope="row">{{$key+=1}}</th>
                <td>{{$seatType->name}}</td>
               
                <td>{{number_format($seatType->price)}} VND</td>
                <td>
                    <a class="btn btn-success" href="{{route('admin.seat_type.edit', $seatType->id)}}"><i class="fas fa-pencil-alt"></i> </a>
                    <a class="btn btn-danger"   OnClick='return confirm("Are you want to delete ?");' href="{{route('admin.seat_type.delete', $seatType->id)}}"><i class="fas fa-trash-alt"></i> </a>
                  
                </td>
            </tr>
        @endforeach --}}
    </tbody>
</table>
@endsection
