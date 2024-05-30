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
            return response()->json([
                'success' => false,
                'message' => 'Thông tin đăng nhập không chính xác'
            ], 401);
        }

        $user = Auth::attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            $request->input('remember')
        );
        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'user' => $user,
            'token' => $token,
            'redirect_url' => route('home') // Route 'home'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
