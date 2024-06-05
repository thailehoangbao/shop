<?php

namespace App\Http\Requests\PostAdmin;

use App\Rules\Iframe;
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
            'title' => 'required|string|max:255',
            'link' => 'nullable|url',
            'video' => ['nullable', new Iframe()],

        ];
    }

    public function messages():array {
        return [
            'title.required' => 'Tiêu đề không được để trống',
            'title.string' => 'Tiêu đề phải là chuỗi',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'link.url' => 'Link không đúng định dạng',
            'video.required' => 'Link video không được để trống',
            'video.iframe' => 'Link video không đúng định dạng iframe',
        ];
    }
}
