@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-white" href="create">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('posts.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="button" class="btn btn-primary text-white ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <br>
    <form action="{{ route('delete.Mulposts') }}" method="POST">
        @csrf
        @method('DELETE')
        <table class="table">
            <thead>
                <tr>
                    <th>Check</th>
                    <th scope="col">STT</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Thời gian đăng</th>
                    <th scope="col">Thời gian sửa</th>
                    <th scope="col">Người đăng</th>
                    <th scope="col">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                    <tr>
                        <th>
                            @if ($post->user->role != 0 || $post->user->id == Auth::id())
                                <input type="checkbox" name="ids[]" value="{{ $post->id }}">
                            @else
                                <h4 class="text-danger">ADMIN</h4>
                            @endif
                        </th>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            <p
                                style=" white-space: nowrap;
                        width: 100px;
                        overflow: hidden;">
                                {{ $post->title }}</p>
                        </td>
                        <td>
                            <p
                                style=" white-space: nowrap;
                        width: 200px;
                        overflow: hidden;">
                                {{ $post->content }}</p>
                        </td>
                        <td><img src="{{ $post->image }}" width="50px" alt=""></td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td class="whitespace-nowrap">
                            @if ($post->user->role != 0 || Auth::user()->id == $post->user->id)
                                <a class="btn btn-success" href="edit/{{ $post->id }}"><i
                                        class="fas fa-trash-alt"></i></a> <a class="btn btn-danger"
                                    onclick=" return confirm('Bạn có chắc chắn xoá?')" href="delete/{{ $post->id }}"><i
                                        class="fas fa-trash-alt"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">Xoá
            mục đã
            chọn</button>
    </form>
    {{ $posts->links() }}
@endsection
