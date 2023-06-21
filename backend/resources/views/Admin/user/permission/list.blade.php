@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')

<button class="btn btn-primary " style="margin-bottom: 10px">
    <a class="text-white" href="{{route('permission.create')}}">Thêm</a>
</button>

    <div class="row">
        @foreach ($permissionsParent as $permissionsParentItem)
            <div class="card  m-3 col-md-11" style="padding: 0">
                <div class="card-header" style="background-color: #ccc">
                   Quyền {{ $permissionsParentItem->name }}
                   <a class="btn btn-success" href="{{route('permission.edit',$permissionsParentItem->id)}}" style="float: right"><i class="fas fa-pencil-alt"></i> </a>
                </div>
                <div class="row">
                    @foreach ($permissionsParentItem->permissionChild as $permissionChildItem)
                        <div class="card-body text-dark col-md-3">
                            <p class="card-title">
                                <label for="">
                                    <input type="checkbox" name="permission_child[]"
                                    {{  $permissionChildItem->check == 1 ? 'checked' : '' }}
                                    id="" class="checkbox_childrent" value="{{$permissionChildItem->id}}" aria-disabled="true" >
                                </label>
                                {{ $permissionChildItem->name }}
                            </p>

                        </div>
                    @endforeach

                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection