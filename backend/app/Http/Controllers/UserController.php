<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ProfileRequests;
use Carbon\Carbon;

class UserController extends Controller
{
    public $roles;
    public function __construct()
    {
        $this->roles = [
            0 => 'Quản trị viên',
            1 => 'Thành viên',
            2 => 'Bị khoá',
            3 => 'Kiểm duyệt viên',

        ];
    }
    public function index()
    {
        return view('admin.index');
    }

    public function show()
    {
        $user = User::latest()->paginate(5);
        return view('admin.user.index', [
            'user' => $user,
            'roles' => $this->roles,
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->input('keywords');
        $user = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('role', 'like', '%' . $query . '%')
            ->paginate(5);
        return view('admin.user.index', [
            'user' => $user,
            'roles' => $this->roles,
        ]);
    }
    public function delete(Request $request)
    {

        $user = User::find($request->id);
        if ($user && $user->role != 0 && $user->delete()) {
            return redirect('admin/users/index')->with('message', 'Xoá thành công');
        } else {
            return redirect('admin/users/index')->with('message', 'Không thể xoá quản trị viên');
        }
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        if (User::where('email', $request->email)->doesntExist()) {
            $newUser = $request->toArray();
            if ($request->hasFile('image')) {
                $file = $request->image;
                $fileExtension = $file->getClientOriginalExtension();
                $file->move("uploads/avatar", $request->email . "." . $fileExtension);
            }
            $newUser['password'] = bcrypt($request->password);
            $newUser['image'] = $request->email . "." . $fileExtension;
            $newUser['created_at'] = Carbon::now();
            User::create($newUser);
            return redirect()->route('users.show')->with('message', 'Đã thêm mới thành công');
        } else {
            return redirect()->route('users.create')->with('message', 'Tài khoản đã tồn tại xin mời tạo lại');
        }
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(ProfileRequests $request)
    {

        $user = User::find($request->id);
        $newUser = $request;
        if ($request->password) {
            $user->password = bcrypt($newUser['password']);
        }
        if ($request->hasFile('image')) {
            $file = $request->image;
            $fileExtension = $file->getClientOriginalExtension();
            $file->move("uploads", $newUser['email'] . "." . $fileExtension);
            $user->image = $newUser['email'] . "." . $fileExtension;
        }

        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->role = $newUser['role'];
        $user->save();


        return redirect()->route('users.show')->with('message', 'Đã Sửa mới thành công');
    }
    public function permise()
    {
        $roles = [
            0 => 'Quản trị viên',
            1 => 'Thành viên',
            2 => 'Bị khoá',
            3 => 'Kiểm duyệt viên',

        ];
        $user = User::paginate(5);
        return view('admin.user.permise', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
    public function permise_admin(Request $request)
    {

        $user = User::find($request->id);
        if ($user) {
            $user->role = $request->stt;
            $user->save();
            return redirect()->route('users.permise')->with('message', 'Update thành công');
        }
    }
}
