<?php

namespace App\Http\Controllers\Client\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientLoginController extends Controller
{
    public function index()
    {
        return view('client.users.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự'
        ]);

        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác');
        }

        $user = Auth::user();
        if (Auth::attempt($credentials)) {
            if ($user->status == 1) {
                // Authentication passed, redirect to home, user is logged in
                return redirect()->route('home')->with('success', 'Login successful!');
            } else if ($user->status == 0) {
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được kích hoạt! Vào email để xác nhận tài khoản!');
            } else if ($user->status == 2) {
                return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa trong 1h vì nhập sai nhiều lần!');
            }
        } else {
            // Authentication failed, redirect back with error
            return redirect()->back()->with('error', 'Login failed!');
        }
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Đăng nhập thành công',
        //     'user' => $user,
        //     'token' => $token,
        //     'redirect_url' => route('home') // Route 'home'
        // ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
