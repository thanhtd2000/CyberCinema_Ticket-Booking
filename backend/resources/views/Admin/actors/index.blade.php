@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Nationality</th>
                <th scope="col">Gender</th>
                <th>
                    <div class="row  align-items-center">
                        <form action="{{ route('admin.actor.search') }}" method="POST" class="d-flex">
                            @csrf
                            <div class="col-auto">
                                <input type="text" name="keywords" id="inputEmail6"
                                    value="{{ isset($keywords) ? $keywords : '' }}" class="form-control"
                                    placeholder="Nhập từ khoá">
                            </div>
                            <button type="submit" class="btn btn-primary text-black ms-3">Tìm kiếm</button>
                        </form>
                    </div>
                </th>
                <th scope="col">
                    <button class="btn btn-primary">
                        <a class="text-white" href="{{ route('admin.actor.create') }}">Add</a>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actors as $key => $actor)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td><img src="{{ $actor->image }}" alt="" width="100px"></td>
                    <td>{{ $actor->name }}</td>
                    <td>{{ date('d/m/Y', strtotime($actor->birthday)) }}</td>
                    <td>{{ $actor->nationality }}</td>
                    <td>{{ $actor->gender == 1 ? 'Nam' : ($actor->gender == 2 ? 'Nữ' : 'Khác') }}</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.actor.edit', $actor->id) }}">Edit</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this actor?')"
                                href="{{ route('admin.actor.destroy', $actor->id) }}"> Delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $actors->links() }}
@endsection
