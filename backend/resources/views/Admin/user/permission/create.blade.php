@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')

    <div class="row">


        <form method="POST" action="{{route('permission.store')}}" class="container">
            @csrf
            <div class="col-md-6" style="padding-left: 0">
                <div class="mb-3">
                    <label class="form-label">Tên quyền</label>
                    <input type="text" name="permission_parent" class="form-control" value="{{ old('permission_parent') }}">

                    @error('permission_parent')
                        <p class="text-red-500 text-xs mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row" style="display: none">
            
                    @foreach (config('permission.permissions_role', []) as $role)
                        <div class="card-body text-dark col-md-3">
                            <label for="">
                                <input type="checkbox" name="permission_child[]" id="" class="checkbox_childrent" checked
                                    value="{{ $role }}">
                            </label>
                            {{ $role }}
                        </div>
                    @endforeach
               


            </div>
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    </div>
@endsection
