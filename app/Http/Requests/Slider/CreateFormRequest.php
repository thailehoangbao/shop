<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'sort_by' => 'required',
            'thumb' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages():array {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'url.required' => 'Đường link không được để trống',
            'sort_by.required' => 'Chọn xấp xếp',
            'thumb.required' => 'Ảnh sai kích thước, định dạng hoặc trống',
        ];
    }
}
