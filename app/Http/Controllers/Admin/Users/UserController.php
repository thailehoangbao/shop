<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        return view('admin.home',[
            'title' => 'Chào mừng bạn đến với trang chính',
            'user' => $user
        ]);
    }
}
