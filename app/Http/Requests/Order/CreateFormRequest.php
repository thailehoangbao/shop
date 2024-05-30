<?php

namespace App\Http\Requests\Order;

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
        // 'product_id' => 'required|exists:products,id',
        'size' => 'required|string',
        'color' => 'required|string',
        'amount' => 'required|integer|min:1|max:1000',
        ];
    }

    public function messages():array {
        return [
            // 'product_id.required' => 'Vui lòng chọn sản phẩm',
            // 'product_id.exists' => 'Sản phẩm không tồn tại',
            'size.required' => 'Vui lòng chọn size',
            'color.required' => 'Vui lòng chọn màu',
            'amount.required' => 'Vui lòng nhập số lượng',
            'amount.integer' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 0',
        ];
    }
}
