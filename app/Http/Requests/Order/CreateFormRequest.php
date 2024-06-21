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
        // 'size' => 'required|string',
        // 'color' => 'required|string',
            'amount' => 'required|integer|min:1|max:1000',
            'note' => 'nullable|string|max:255'
        ];
    }

    public function messages():array {
        return [
            'note.max' => 'Ghi chú không được vượt quá 255 ký tự',
            // 'size.required' => 'Vui lòng chọn size',
            // 'color.required' => 'Vui lòng chọn màu',
            'amount.required' => 'Vui lòng nhập số lượng',
            'amount.integer' => 'Số lượng phải là số',
            'amount.min' => 'Số lượng phải lớn hơn 0',
        ];
    }
}
