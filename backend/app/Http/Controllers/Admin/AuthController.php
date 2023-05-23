<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function getLogin()
    {
        return view('Admin.login');
    }

    public function checkLogin(Request $request)
    {
        $rule = [
            'email' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'required' => 'Trường bắt buộc phải nhập'
        ];
        $user = $request->validate($rule, $messages);
        $remember = $request->has('remember');
        if (Auth::attempt(['email' => $user['email'], 'password' => $user['password']], $remember)) {
            if (Auth::user()->role == 0 || Auth::user()->role == 3) {
                return redirect('admin/index')->with('message', 'Đăng nhập thành công');
            } else if (Auth::user()->role == 2) {
                Auth::logout();
                return redirect('/')->with('message', 'Tài khoản đã bị khoá không thể sử dụng các tính năng của website , hãy liên hệ
                admin để nhận trợ giúp');
            } else {
                return redirect('/');
            }
        } else {
            return redirect()->route('login')->with('message', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('login')->with('message', 'Đăng xuất thành công');
    }
}
