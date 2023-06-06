@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">
                    <button class="btn btn-primary">
                        <a class="text-white" href="{{ route('admin.product.create') }}">Add</a>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <th scope="row">{{ $key += 1 }}</th>
                    <td>{{ $product->name }}</td>
                    {{-- <td>{{$product->price}}</td> --}}
                    <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                    <td>
                        <button class="btn btn-primary">
                            <a class="text-white" href="{{ route('admin.product.edit', $product->id) }}">Edit</a>
                        </button>
                        <button class="btn btn-danger">
                            <a class="text-white" onclick="return confirm('Really delete this product?')"
                                href="{{ route('admin.product.delete', $product->id) }}"> Delete</a>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
