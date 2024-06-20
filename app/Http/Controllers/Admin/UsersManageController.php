<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManage\CreateFormRequest;
use App\Http\Services\Users_Manage\UsersServices;
use App\Models\User;
use Illuminate\Http\Request;

class UsersManageController extends Controller
{
    protected $usersService;

    public function __construct(UsersServices $usersService)
    {
        $this->usersService = $usersService;
    }

    public function create()
    {
        return view('admin.usersmanage.add',[
            'title' => 'Thêm Người Dùng'
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->usersService->store($request);
        if(!$result){
            return redirect()->back()->with('error', 'Thêm người dùng thất bại');
        }
        return redirect()->back()->with('success', 'Thêm người dùng thành công');
    }

    public function index()
    {
        $result = $this->usersService->getAll();
        if(!$result){
            return redirect()->back()->with('error', 'Không có người dùng nào');
        }
        return view('admin.usersmanage.list',[
            'title' => 'Danh Sách Người Dùng',
            'users' => $result
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->usersService->destroy($request->id);
        if(!$result){
            return redirect()->back()->with('error', 'Xóa người dùng thất bại');
        }
        return redirect()->back()->with('success', 'Xóa người dùng thành công');
    }

    public function show($user)
    {
        $result = $this->usersService->edit($user);
        if(!$result){
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }
        return view('admin.usersmanage.edit',[
            'title' => 'Chi Tiết Người Dùng',
            'user' => $result
        ]);
    }

    public function update(CreateFormRequest $request)
    {
        $result = $this->usersService->update($request);
        if(!$result){
            return redirect()->back()->with('error', 'Không tìm thấy người dùng');
        }
        return redirect()->back()->with('success', 'Cập nhật người dùng thành công');
    }
}
