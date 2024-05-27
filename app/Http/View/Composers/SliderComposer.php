<?php
//Đóng gói dữ liệu từ data
namespace App\Http\View\Composers;

use App\Models\Slider;
use Illuminate\View\View;

class SliderComposer
{
    public function __construct(public Slider $sliders) {

    }

    public function compose(View $view)
    {
        $sliders = Slider::where('active',1)->orderByDesc('id')->get();
        // Truyền dữ liệu vào view composer
        $view->with('sliders',$sliders);
    }
}
