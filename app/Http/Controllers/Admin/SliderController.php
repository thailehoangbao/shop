<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\CreateFormRequest;
use App\Http\Services\Slider\SliderServices;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $sliderServices;

    public function __construct(SliderServices $sliderServices)
    {
        $this->sliderServices = $sliderServices;
    }

    public function create()
    {
        return view('admin.slider.add',[
            'title' => 'Thêm slide'
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $this->sliderServices->store($request);
        return redirect()->back();
    }

    public function index()
    {
        $sliders = $this->sliderServices->getAll();
        return view('admin.slider.list',[
            'title' => 'Danh sách slide',
            'sliders' => $sliders
        ]);
    }

    public function destroy(Request $request)
    {
        $result = $this->sliderServices->delete($request->id);
        if($result){
            return redirect()->back();
        }
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit',[
            'title' => 'Chỉnh Sửa Slide '.$slider->name,
            'slider' => $slider
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->sliderServices->update($request, $slider);
        return redirect()->back();
    }
}
