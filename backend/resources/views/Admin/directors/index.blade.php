@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Birthday</th>
                <th scope="col">Nationality</th>
                <th scope="col">Gender</th>
                <th scope="col">
                    <button class="btn btn-primary">
                        <a class="text-white" href="{{ route('admin.director.create') }}">Add</a>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($directors as $key => $director)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $director->name }}</td>
                    <td>{{ date('d/m/Y', strtotime($director->birthday)) }}</td>
                    <td>{{ $director->nationality }}</td>
                    <td>{{ $director->gender == 1 ? 'Nam' : ($director->gender == 2 ? 'Nữ' : 'Khác') }}</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.director.edit', $director->id) }}">Edit</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this director?')"
                                href="{{ route('admin.director.destroy', $director->id) }}"> Delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $directors->links() }}
@endsection
