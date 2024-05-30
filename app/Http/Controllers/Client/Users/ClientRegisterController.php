<?php

namespace App\Http\Controllers\Client\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            // Authentication passed, redirect to home
            return redirect()->route('home')->with('success', 'Login successful!');
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
            'remember_token' => $request->remember
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Redirect to home with success message
        return redirect()->route('home')->with('success', 'Registration and login successful!');
    }
    }
}
