<?php
//php artisan make:request Menu/CreateFormRequest
namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // chỉnh lại
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
        ];
    }

    public function messages():array {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'content.required' => 'Nội dung không được để trống',
            'description.required' => 'Mô tả không được để trống',
        ];
    }
}
