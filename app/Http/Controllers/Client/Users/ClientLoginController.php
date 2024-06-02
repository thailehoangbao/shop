<?php

namespace App\Http\Controllers\Client\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
                $newUser = User::where('email', $request->email)->first();
                // Create a token for the authenticated user
                $token = JWTAuth::fromUser($newUser);
                $newUser->token = $token;
                $newUser->save();

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
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function forgotPassword()
    {
        return view('client.users.forgotpassword');
    }

    public function sendEmailForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = $user->token;
            if(!$token) {
                return redirect()->back()->with('error', 'Tài khoản bạn chưa kích hoạt! Vui lòng vào email để kích hoạt tài khoản!');
            }
            Mail::send('email.forgotemail', ['user' => $user,'token' => $token], function ($message) use ($user) {
                $message->subject('Shopping - Gửi lại xác nhận email của bạn!');
                $message->to($user->email, $user->name);
            });
            return redirect()->route('home')->with('success', 'Vui lòng kiểm tra email để lấy lại mật khẩu!');
        } else {
            return redirect()->back()->with('error', 'Email không tồn tại!');
        }
    }

    public function resetPassword($id,$token)
    {
        $user = User::where('id', $id)->first();
        if ($user->token == $token) {
            if($user->status == 2){
                return redirect()->route('home')->with('error', 'Tài khoản của bạn đã bị khóa trong 1h vì nhập sai nhiều lần!');
            } else if($user->status == 0){
                return redirect()->route('home')->with('error', 'Tài khoản của bạn chưa được kích hoạt! Vào email để xác nhận tài khoản!');
            }
            return view('client.users.resetpassword', [
                'user' => $user
            ]);
        } else {
            return redirect()->route('home')->with('error', 'Token không hợp lệ!');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ], [
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'confirm_password.required' => 'Mật khẩu xác nhận không được để trống',
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp'
        ]);

        $user = User::where('id', $request->id)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('home')->with('success', 'Đổi mật khẩu thành công!');
    }
}
