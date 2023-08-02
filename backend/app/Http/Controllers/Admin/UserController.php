<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\FirebaseHelper;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequests;

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
        return view('Admin.index');
    }

    public function show(Request $request)
    {
        $keywords = $request->input('keywords');
        if ($keywords) {

            $user = User::search($keywords)->paginate(5);
            return view('Admin.user.index', [
                'user' => $user,
                'roles' => $this->roles,
                'keywords' => $keywords
            ]);
        } else {
            $user = User::latest()->paginate(5);
            return view('Admin.user.index', [
                'user' => $user,
                'roles' => $this->roles,
            ]);
        }
    }

    public function delete(Request $request)
    {

        $user = User::find($request->id);
        if ($user && $user->role != 0 && $user->delete()) {
            return redirect('Admin/users/index')->with('message', 'Xoá thành công');
        } else {
            return redirect('Admin/users/index')->with('message', 'Không thể xoá quản trị viên');
        }
    }
    public function create()
    {
        return view('Admin.user.create');
    }

    public function store(UserRequest $request)
    {
        $path = 'Avatars/';
        if (User::where('email', $request->email)->doesntExist()) {
            $newUser = $request->toArray();
            $image = $request->file('image');
            $newUser['image'] = $this->firebaseHelper->uploadimageToFireBase($image, $path);
            $newUser['password'] = bcrypt($request->password);
            $newUser['points'] = 0;
            User::create($newUser);
            return redirect()->route('users.show')->with('message', 'Đã thêm mới thành công');
        } else {
            return redirect()->route('users.create')->with('message', 'Tài khoản đã tồn tại xin mời tạo lại');
        }
    }
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        return view('Admin.user.edit', compact('user'));
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
        return view('Admin.user.permise', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
    public function permise_Admin(Request $request)
    {

        $user = User::find($request->id);
        if ($user) {
            $user->role = $request->stt;
            $user->save();
            return redirect()->route('users.permise')->with('message', 'Update thành công');
        }
    }
    public function viewchange()
    {
        return view('Admin.user.change');
    }
    public function change(Request $request)
    {
        $rules = [
            'password' => 'required|min:8|max:24|confirmed',
        ];
        $message = [
            'required' => 'Bắt buộc phải nhập',
            'confirmed' => 'Xác nhận mật khẩu phải trùng nhau',
            'min' => 'Phải lớn hơn :min ký tự',
            'max' => 'Phải nhỏ hơn :max ký tự',
        ];
        $user = User::find(Auth::id());
        $passwordData = $request->validate($rules, $message);
        $user->password = bcrypt($passwordData['password']);
        $user->updated_at = Carbon::now();
        $user->save();
        return redirect()->back()->with('message', 'Đã thay đổi mật khẩu thành công');
    }
}
