<?php

namespace App\Http\Requests\Profile;

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
            'phone_number' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'avatar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages():array {
        return [
            'phone_number.regex' => 'Số điện thoại không hợp lệ',
            'phone_number.min' => 'Số điện thoại không hợp lệ',
            'avatar.required' => 'Ảnh sai kích thước, định dạng hoặc trống',
        ];
    }
}
