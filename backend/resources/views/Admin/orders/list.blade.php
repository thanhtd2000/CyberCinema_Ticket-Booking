@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div></div>
        <div class="row align-items-center">
            <form action="" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" class="form-control" placeholder="Nhập từ khoá">
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
                <th class="">Mã giảm giá</th>
                <th class="">Mã giao dịch</th>
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
                    <td class="">{{ $order->user->name }}</td>
                    <td class="">
                        {{ $order->discount == null ? 'Không có' : $order->discount->code }}</td>
                    <td class="">
                        {{ $order->transaction == null ? 'Không có' : $order->transaction->transactions_code }}
                    </td>
                    <td class="">{{ $order->order_code }}</td>
                    <td class="">
                        @if ($order->status === 1)
                            Chờ thanh toán
                        @elseif ($order->status === 2)
                            Đã thanh toán
                        @elseif ($order->status === 3)
                            Đã hủy
                        @endif
                    </td>
                    <td class="">{{ $order->created_at }}</td>
                    <td class="">{{ $order->total }}</td>
                    <td class="">
                        <button class="btn btn-warning">
                            <a class="text-white" href="#"><i class="fas fa-trash-alt"></i></a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{ $transactions->links() }} --}}
@endsection
