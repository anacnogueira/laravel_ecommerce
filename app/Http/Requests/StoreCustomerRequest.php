<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreCustomerRequest extends FormRequest
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
       $rules = [
            'type_person' => ['required','in:pf,pj'],
            'name' => ['required'],
            'email' => ['required','string', 'email','max:255','unique:contacts,email'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'mobile' => ['required'],
            'privacy' => ['accepted']
        ];

        if ($this->type_person === 'pf') {
            $rules = array_merge($rules, [
                'cpf' => ['required','cpf','formato_cpf','unique:contacts,cpf'],
            ]);
        } elseif ($this->type_person === 'pj') {
            $rules = array_merge($rules, [
                'cnpj' => ['required','cnpj','formato_cnpj','unique:contacts,cnpj'],

            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'email' => 'Formato de e-mail inválido',
            'email.unique' => 'E-mail já cadastrado',
            'confirmed' =>'A confirmação da senha não corresponde',
            'cpf.unique' => 'CPF já cadastrado',
            'cnpj.unique' => 'CNPJ já cadastrado',
            'accepted' => 'Concorde com os termos de uso',
            'password' => [
                'min'=> 'A senha deve ter pelo menos :min caracteres.',
                'max'=> 'A senha deve ter pelo menos :max caracteres.',
            ],
        ];
    }
}
