<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;
use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    public function __construct(public Menu $menus) {

    }

    public function compose(View $view)
    {
        $menus = Menu::where('active',1)->orderByDesc('id')->get();
        // Truyền dữ liệu vào view composer
        $view->with('menus',$menus);
    }
}
