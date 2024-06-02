<?php

namespace App\Http\Requests\Payment;

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
            'address' => 'required|string',
            'phone' => 'required|string|min:10|max:11|regex:/^0[0-9]{9,10}$/'
        ];
    }

    public function messages():array {
        return [
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Số điện thoại không hợp lệ',
        ];
    }
}
