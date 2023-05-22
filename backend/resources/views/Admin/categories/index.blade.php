@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th>
                    <div class="row  align-items-center">
                        <form action="{{ route('admin.category.search') }}" method="POST" class="d-flex">
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
                        <a class="text-white" href="{{ route('admin.category.create') }}">Add</a>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.category.edit', $category->id) }}">Edit</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this category?')"
                                href="{{ route('admin.category.destroy', $category->id) }}"> Delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection
