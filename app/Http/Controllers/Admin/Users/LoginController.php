<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\c;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.login', [
            'title' => 'Chào mừng bạn đến với trang đăng nhập'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:filter',
            'password' => 'required|min:6|max:12'
        ]);

        //kiểm tra người dùng nhập vào có khớp data kg
        if (Auth::attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            $request->input('remember')
        )) {
            return redirect()->route('admin');
        }

        Session::flash('error', 'Email hoặc mật khẩu không chính xác');
        return redirect()->back();
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // return redirect()->route('admin.users.login.index');
    }

    // Phương thức logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/users/login'); // Chuyển hướng về trang chủ hoặc trang đăng nhập
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}
