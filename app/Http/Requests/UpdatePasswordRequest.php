<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
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
            'token' => ['required'],
            'email' => ['required','email'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }

     public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'confirmed' =>'A confirmação da senha não corresponde',
            'password' => [
                'min'=> 'A senha deve ter pelo menos :min caracteres.',
                'max'=> 'A senha deve ter pelo menos :max caracteres.',

            ],
        ];
    }
}
