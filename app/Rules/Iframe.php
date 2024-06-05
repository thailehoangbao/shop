<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Iframe implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Kiểm tra nếu giá trị không rỗng và là một chuỗi
        if (!is_string($value) || empty($value)) {
            $fail('The :attribute must be a valid iframe.');
            return;
        }

        // Kiểm tra nếu giá trị chứa thẻ iframe
        if (!preg_match('/<iframe.*<\/iframe>/', $value)) {
            $fail('The :attribute must be a valid iframe.');
        }
    }
}
