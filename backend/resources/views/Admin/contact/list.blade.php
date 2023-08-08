@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <div class="row g-3 align-items-center ">
        <form action="{{ route('admin.contact.search') }}" method="POST" class="d-flex">
            @csrf
            <div class="col-md-4">
                <input type="text" name="keywords" id="inputEmail6" value="{{ isset($keywords) ? $keywords : '' }}"
                    class="form-control" placeholder="Nhập tên khách hàng,email,nội dung ...">
            </div>
            <button type="submit" class="btn btn-primary text-white">Tìm kiếm</button>
        </form>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên khách</th>
                <th scope="col">SĐT</th>
                <th scope="col">Email</th>
                <th scope="col">Nội Dung</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Xác nhận</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key => $contact)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td style="font-weight: bold">{{ $contact->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->content }}</td>
                    <td>
                        @if ($contact->status == 0)
                            <button type="button" class="btn btn-primary"
                                style="width:140px ; font-size: 13px ; font-weight:bold"><i class="far fa-clock"></i> Đã
                                tiếp nhận</button>
                        @elseif ($contact->status == 1)
                            <button type="button" class="btn btn-success"
                                style="width:140px ; font-size: 13px ; font-weight:bold"><i class="fas fa-check"></i> Đã xử
                                lý</button>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-outline-success">
                            <a class="" href="{{ route('admin.contact.update', $contact->id) }}"
                                onclick="return confirm('Bạn có chắc chắn xác nhận là đã xử lý ?')"><i class="fas fa-check"
                                    style="color: #30c048;"></i></a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
@endsection
