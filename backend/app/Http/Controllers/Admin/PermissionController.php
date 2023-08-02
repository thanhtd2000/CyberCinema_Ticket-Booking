<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    public $role;
    public function __construct(Role $role)
    {
      $this->role = $role;
    }

    function index()
    {
        $permissionsParent = $this->role->where('parent_id', 0)->get();

        return view('admin/user/permission/list', compact('permissionsParent'));
    }
    function create()
    {
        return view('admin/user/permission/create');
    }

    function store(PermissionRequest $request)
    {
           $permission_parent = $this->role->create([
               'name'=>$request->permission_parent,
               'parent_id'=>0
           ]);
           foreach($request->permission_child as $child){
               $this->role->create([
                   'name'=>$child .' '.$permission_parent->name,
                   'key'=> Str::slug($child,'-') .'-'.Str::slug($permission_parent->name,'-'),
                   'check'=>0,
                   'parent_id'=>$permission_parent->id
               ]);
   
           }
           return redirect()->route('permission.list')->with('message','Thêm quyền thành công!');
    }

    public function edit($id){
        $permission_parent = $this->role->where('parent_id',0)->find($id);
        $permission_child =$this->role->where('parent_id',$id)->get();
        return view('admin/user/permission/edit',compact('permission_parent','permission_child'));
    }

    public function update(Request $request)
    {
       $permissionChilds = $this->role->where('parent_id',$request->parent_id)->pluck('id')->toArray();
       
    
        foreach($permissionChilds as $permiss){
         
            if(in_array($permiss,$request->permission_child)){
                $this->role->find($permiss)->update([
                 'check'=>1
                ]);
            }else{
                $this->role->find($permiss)->update([
                    'check'=>0
                   ]);
            }
        }
        return redirect()->route('permission.list')->with('message','Sửa quyền thành công!');

    }
}
