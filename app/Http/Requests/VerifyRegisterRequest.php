<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyRegisterRequest extends FormRequest
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
            'email_reg' => [
                'required',
                'email',
                Rule::unique('contacts','email')->where(fn ($query) => $query->where('type_contact', 'client'))
            ],
        ];
    }

     public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'email' => 'Formato de e-mail inválido',
            'email_reg.unique' => 'E-mail já cadastrado',
        ];
    }
}
