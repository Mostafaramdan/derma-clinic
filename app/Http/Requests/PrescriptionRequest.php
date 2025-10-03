<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'medications' => ['nullable', 'array'],
            'medications.*' => ['exists:medications,id'],
            'advices' => ['nullable', 'array'],
            'advices.*' => ['exists:advices,id'],
        ];
    }
}
