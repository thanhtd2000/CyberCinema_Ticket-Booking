@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <button type="submit" class="btn btn-primary "><a class="text-white" href="{{ route('admin.discount.create') }}">Thêm
                mới</a></button>
        <div class="row g-3 align-items-center ">
            <form action="{{ route('admin.discount.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" value="{{ isset($keywords) ? $keywords : '' }}"
                        class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="submit" class="btn btn-primary text-white">Tìm kiếm</button>
            </form>
        </div>
    </div>

    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Mã giảm giá</th>
                <th scope="col">Tiền tối thiểu áp dụng</th>
                <th scope="col">Tiền tối đa triết khấu</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Thời gian áp dụng</th>
                <th scope="col">Thời gian kết thúc</th>
                <th scope="col">Phần trăm triết khấu</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $key => $discount)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $discount->code }}</td>
                    <td>{{ number_format($discount->min_price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ number_format($discount->max_price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $discount->count }}</td>
                    <td>{{ date('d/m/Y', strtotime($discount->start_time)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($discount->end_time)) }}</td>
                    <td>{{ $discount->percent }}%</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.discount.edit', $discount->id) }}"><i
                                    class="fas fa-pencil-alt"></i></a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"
                                href="{{ route('admin.discount.delete', $discount->id) }}"><i
                                    class="fas fa-trash-alt"></i></a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $discounts->links() }}
@endsection
