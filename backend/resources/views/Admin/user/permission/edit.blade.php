@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')

  


        <form method="POST" action="{{route('permission.update')}}" class="container">
            @csrf
            @method('put')
            <div class="col-md-6" style="padding-left: 0">
                <div class="mb-3">
                    <label class="form-label">Tên quyền</label>
                    <input type="hidden" name="parent_id" value="{{$permission_parent->id}}">
                    <input type="text" name="permission_parent" class="form-control" value="{{$permission_parent->name}}" readonly>

                    @error('permission_parent')
                        <p class="text-red-500 text-xs mt-1" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                @foreach ($permission_child as $permissionChildItem)
                    <div class="card-body text-dark col-md-3">
                        <p class="card-title">
                            <label for="">
                                <input type="checkbox" name="permission_child[]"
                                {{  $permissionChildItem->check == 1 ? 'checked' : '' }}
                                id="" class="checkbox_childrent" value="{{$permissionChildItem->id}}" >
                            </label>
                            {{ $permissionChildItem->name }}
                        </p>

                    </div>
                @endforeach

            </div>
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </form>
    
@endsection
