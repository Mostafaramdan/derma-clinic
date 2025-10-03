<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadiologyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ];
    }
}
