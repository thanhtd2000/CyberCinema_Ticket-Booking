@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div></div>
        <div class="row align-items-center">
            <form action="{{route('admin.order.search')}}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keyname" id="inputEmail6" class="form-control" placeholder="Nhập tên khách hàng"  value="{{ isset($keyname) ? $keyname : '' }}">
                </div>
                <div class="col-auto">
                    <input type="date" name="keydate" id="inputEmail6" class="form-control" placeholder="Tìm kiếm theo ngày" value="{{ isset($keydate) ? $keydate : '' }}">
                </div>
                <div class="col-auto">
                    <select  class="form-control" id="" name="keystatus">
                       
                        <option value="">Trạng thái</option>
                        <option @if(isset($keystatus) && $keystatus ==1) selected @endif value="1">Chờ thanh toán</option>
                        <option @if(isset($keystatus) && $keystatus ==2) selected @endif value="2">Đã thanh toán</option>
                        <option @if(isset($keystatus) && $keystatus ==3) selected @endif value="3">Đã hủy</option>
                       
                      </select>
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th class="">STT</th>
                <th class="">Khách hàng</th>
               
               
                <th class="">Mã thanh toán</th>
                <th class="">Trạng thái</th>
                <th class="">Ngày thanh toán</th>
                <th class="">Tổng tiền</th>
                <th class="">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
                <tr>
                    <td class="">{{ $key += 1 }}</td>
                    <td class="" style="font-weight: bold">{{ $order->user->name }}</td>
                    
                    
                    <td class="">{{ $order->order_code }}</td>
                    <td class="">
                        @if ($order->status === 1)
                            <button type="button" class="btn btn-primary" style="width:140px ; font-size: 13px ; font-weight:bold"><i class="far fa-clock"></i> Chờ thanh toán</button>
                        @elseif ($order->status === 2)
                           <button type="button" class="btn btn-success" style="width:140px ; font-size: 13px ; font-weight:bold"><i class="fas fa-check"></i> Đã thanh toán</button>
                        @elseif ($order->status === 3)
                            <button type="button" class="btn btn-danger" style="width:140px ; font-size: 13px ;font-weight:bold"><i class="fas fa-times"></i> Đã hủy</button>
                        @endif
                    </td>
                    <td class="">{{ $order->created_at }}</td>
                    <td class="" style="font-weight: bold">{{ number_format($order->total) }} VND</td>
                    <td class="" style="width:200px ; display: flex;    justify-content: space-around">
                        @if ($order->status === 3)

                        @else
                            <form action="{{ route('admin.order.cancel', $order->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" onclick='return confirm("Bạn có muốn hủy không")'
                                    class="btn btn-warning">
                                Hủy Đơn
                                </button>
                            </form>
                        @endif
                        <a href="" class="btn btn-primary" style="">Chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
