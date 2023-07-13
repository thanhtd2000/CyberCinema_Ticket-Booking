@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-white" href="">Thêm mới</a></button>
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
                {{-- <th class="">Người giao dịch</th> --}}
                <th class="">Mã giao dịch</th>
                <th class="">Mã ngân hàng</th>
                <th class="">Mã thanh toán</th>
                <th class="">Trạng thái</th>
                <th class="">Số tiền</th>
                <th class="">Ngày thanh toán</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $key => $transaction)
                <tr>
                    <td class="">{{ $key += 1 }}</td>
                    {{-- <td class="">{{ $transaction->users->name }}</td> --}}
                    <td class="">{{ $transaction->transactions_code }}</td>
                    <td class="">{{ $transaction->bank_code }}</td>
                    <td class="">{{ $transaction->payment_code }}</td>
                    <td class="">{{ $transaction->status === 0 ? 'Đã thanh toán' : 'Chưa thanh toán' }}</td>
                    <td class="">{{ $transaction->amount }}</td>
                    <td class="">{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{ $transactions->links() }} --}}
@endsection
