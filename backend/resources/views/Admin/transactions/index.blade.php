@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> 
        <div class="row align-items-center">
            <form action="{{ route('admin.transaction.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <select class="form-control" id="" name="keystatus">
                        <option value="">Trạng thái</option>
                        <option @if (isset($keystatus) && $keystatus == 2) selected @endif value="2">Đã thanh toán</option>
                        <option @if (isset($keystatus) && $keystatus == 3) selected @endif value="3">Đã hủy</option>

                    </select>
                </div>
                <div class="col-auto">
                    <input type="date" name="keydate" id="inputEmail6" class="form-control"
                        placeholder="Tìm kiếm theo ngày">
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th class="">STT</th>
                {{-- <th class="">Người giao dịch</th> --}}
                <th class="">Mã giao dịch</th>
                <th class="">Mã hóa đơn</th>
                <th class="">Ngân hàng</th>
                <th class="">Hình thức TT</th>
                <th class="">Trạng thái</th>
                <th class="">Số tiền</th>
                <th class="">Thời gian GD</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $key => $transaction)
                <tr>
                    <td class="">{{ $key += 1 }}</td>
                    {{-- <td class="">{{ $transaction->users->name }}</td> --}}

                    <td class="" style="font-weight: bold">{{ $transaction->transactions_code }}</td>
                    <td class="" style="font-weight: bold">{{ $transaction->order_code }}</td>
                    <td class="" style="font-weight: bold">{{ $transaction->bank_code }}</td>
                    <td class="" style="font-weight: bold">{{ $transaction->payment_code }}</td>
                    <td class="">

                        @if ($transaction->status == 2)
                            <button type="button" class="btn btn-success"
                                style="width:140px ; font-size: 14px ; font-weight:bold"><i class="fas fa-check"></i> Đã
                                thanh toán</button>
                        @else
                            <button type="button" class="btn btn-danger"
                                style="width:140px ; font-size: 14px ;font-weight:bold"><i class="fas fa-times"></i> Đã
                                hủy</button>
                        @endif
                    <td class="" style="font-weight: bold">{{ number_format($transaction->amount) }} VND</td>

                    <td class="" style="font-weight: bold">{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $transactions->links() }}
@endsection
