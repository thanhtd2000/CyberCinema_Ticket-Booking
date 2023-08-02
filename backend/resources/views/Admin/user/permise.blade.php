@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <button type="button" class="btn btn-primary"><a class="text-white" href="create">Thêm mới</a></button>
    <br>
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
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $us->name }}</td>
                    <td>{{ $us->email }}</td>
                    <td>{{ $roles[$us->role] ?? '' }}
                    </td>
                    <td><img src="../../../uploads/{{ $us->avatar }}" width="30px" alt=""></td>
                    <td>{{ $us->created_at }}</td>
                    <td>
                        @if ($us->role != 0)
                            @if (!in_array($us->role, [2, 3]))
                                <button type="button" class="btn btn-success">
                                    <a class="text-white" onclick="return confirm('Bạn có chắc chắn muốn chuyển quyền?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 3]) }}">Kiểm duyệt</a>
                                </button>
                            @endif
                            @if (in_array($us->role, [1, 3]))
                                <button type="button" class="btn btn-danger">
                                    <a class="text-white" onclick="return confirm('Bạn có chắc chắn block?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 2]) }}">Block</a>
                                </button>
                            @endif
                            @if (!in_array($us->role, [1, 2]))
                                <button type="button" class="btn btn-info">
                                    <a class="text-white" onclick="return confirm('Bạn có chắc chắn muốn chuyển quyền?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 1]) }}">Thành viên</a>
                                </button>
                            @endif
                            @if ($us->role == 2)
                                <button type="button" class="btn btn-success">
                                    <a class="text-white" onclick="return confirm('Bạn có chắc chắn muốn chuyển quyền?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 3]) }}">Kiểm duyệt</a>
                                </button>
                                <button type="button" class="btn btn-info">
                                    <a class="text-white" onclick="return confirm('Bạn có chắc chắn muốn chuyển quyền?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 1]) }}">Thành viên</a>
                                </button>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $user->links() }}
@endsection
