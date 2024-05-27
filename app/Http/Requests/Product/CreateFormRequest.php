<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'content' => 'required',
            'description' => 'required',
            'thumb' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages():array {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'content.required' => 'Nội dung sản phẩm không được để trống',
            'description.required' => 'Mô tả sản phẩm không được để trống',
            'thumb.required' => 'Ảnh sai kích thước, định dạng hoặc trống',
        ];
    }
}
