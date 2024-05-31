<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = Roles::all();
        return view('admin.users.register',[
            'title' => 'Chào mừng bạn đến trang đăng ký',
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'role_id.required' => 'Vui lòng chọn quyền'
        ]);

        $data = $request->except('_token');
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.login')->with('success','Đăng ký tài khoản thành công');
    }
}
