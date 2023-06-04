@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-white" href="create">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('users.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" value="{{ isset($keywords) ? $keywords : '' }}"
                        class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="submit" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Avatar</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $key => $us)
                @if ($us->role != 0)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $us->name }}</td>
                        <td>{{ $us->email }}</td>
                        <td>{{ $roles[$us->role] ?? '' }}</td>
                        <td><img src="{{ $us->image }}" width="30px" alt=""></td>
                        <td>{{ $us->created_at }}</td>
                        <td>
                            @if (!$us->role == 0 && $us->id != Auth::user()->id)
                                <a class="text-white btn btn-success" href="edit/{{ $us->id }}"><i
                                        class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger" onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                    href="delete/{{ $us->id }}"><i class="fas fa-trash-alt"></i></a>
                            @endif

                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    {{ $user->links() }}
@endsection
