<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordCustomerRequest extends FormRequest
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
            'old_password' => ['required','current_password'],
            'password' => ['required', 'confirmed', 'between:6,15'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'confirmed' =>'A confirmação da senha não corresponde',
        ];
    }
}
