<?php

namespace App\Http\Controllers\Client\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientRegisterController extends Controller
{
    public function index() {
        return view('client.users.register');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required'
        ],[
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự'
        ]);

        // Check if the user already exists
    $user = User::where('email', $request->email)->first();

    if ($user) {
        // User exists, attempt to log in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if($user->status == 1) {
            // Authentication passed, redirect to home, user is logged in
                return redirect()->route('home')->with('success', 'Login successful!');
            }  else if ($user->status == 0) {
                return redirect()->back()->with('error', 'Tài khoản của bạn chưa được kích hoạt!');
            }
        } else {
            // Authentication failed, redirect back with error
            return redirect()->back()->with('error', 'Login failed!');
        }
    } else {

        // User does not exist, create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'remember_token' => $request->remember,
            'status' => 0
        ]);

        $token = JWTAuth::fromUser($user);

        // Log the user in after registration
        // Auth::login($user);
        Mail::send('email.register', ['user' => $user,'token' => $token], function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject('Shopping - Xác nhận tài khoản');
            $message->from('diamondriverside.vip@gmail.com', 'MiuMiu Store');
        });
        // Redirect to home with success message
        return redirect()->route('home')->with('success', 'Vui lòng vào Email của bạn để xác thực tài khoản!');
    }
    }
}
