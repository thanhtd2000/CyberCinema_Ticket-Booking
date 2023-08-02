@extends('Admin.layouts.footer')
@extends('Admin.layouts.master')
@extends('Admin.layouts.header')
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
                @foreach ($permission_child as $key => $permissionChildItem)
                <div class="custom-control custom-switch col-md-3">
                    <input type="checkbox" class="custom-control-input" id="customSwitch{{$key}}"  {{  $permissionChildItem->check == 1 ? 'checked' : '' }} value="{{$permissionChildItem->id}}" name="permission_child[]" >
                    <label class="custom-control-label" for="customSwitch{{$key}}">{{ $permissionChildItem->name }}</label>
                  </div>
                    
                @endforeach

            </div>
            <button type="submit" class="btn btn-outline-primary mt-3">Submit</button>
        </form>
    
@endsection
