<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequests;
use App\Helpers\FirebaseHelper;

class UserController extends Controller
{
    public $roles;
    public $firebaseHelper;
    public function __construct()
    {
        $this->roles = [
            0 => 'Quản trị viên',
            1 => 'Thành viên',
            2 => 'Bị khoá',
            3 => 'Kiểm duyệt viên',

        ];
        $this->firebaseHelper = new FirebaseHelper();
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
        $keywords = $request->input('keywords');
        $user = User::where('name', 'like', '%' . $keywords . '%')
            ->orWhere('email', 'like', '%' . $keywords . '%')
            ->paginate(5);
        return view('admin.user.index', [
            'user' => $user,
            'roles' => $this->roles,
            'keywords' => $keywords
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
        $path = 'Avatars/';
        if (User::where('email', $request->email)->doesntExist()) {
            $newUser = $request->toArray();
            $image = $request->file('image');
            $newUser['image'] = $this->firebaseHelper->uploadimageToFireBase($image, $path);
            $newUser['password'] = bcrypt($request->password);
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
        $path = 'Avatars/';
        $user = User::find($request->id);
        $newUser = $request;
        if ($request->password) {
            $user->password = bcrypt($newUser['password']);
        }
        if ($request->hasFile('image')) {
            $this->firebaseHelper->deleteImage($user->image, $path);
            $image = $request->file('image');
            $user->image = $this->firebaseHelper->uploadimageToFireBase($image, $path);
        }
        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->role = $newUser['role'];
        $user->phone = $newUser['phone'];
        $user->sex = $newUser['sex'];
        $user->birthday = $newUser['birthday'];
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
