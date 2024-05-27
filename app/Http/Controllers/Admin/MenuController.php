<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuServices;
use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    protected $menuServices;

    public function __construct(MenuServices $menuServices)
    {
        $this->menuServices = $menuServices;
    }


    public function create(){
        return view('admin.menu.add',[
            'title' => 'Thêm Danh Mục Mới',
            'menus' => $this->menuServices->get(0)
        ]);
    }

    public function store(CreateFormRequest $request){

        $result = $this->menuServices->create($request);

        return redirect()->back();
    }

    public function index(){
        return view('admin.menu.list',[
            'title' => 'Danh Sách Danh Mục',
            'menus' => $this->menuServices->getList()
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->menuServices->delete($request->id);
        if($result){
            return redirect()->back();
        }
    }



    public function show(Menu $menu)
    {
        return view('admin.menu.edit',[
            'title' => 'Chỉnh Sửa Danh Mục '.$menu->name,
            'menu' => $menu,
            'menus' => $this->menuServices->get(0)
        ]);
    }

    public function update(CreateFormRequest $request, Menu $menu)
    {
        $result = $this->menuServices->update($request,$menu);
        if($result){
            return redirect()->back();
        }
    }
}
