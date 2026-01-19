<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStoreUpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type_person' => ['required','in:pf,pj'],
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts')->ignore($this->customer)
            ],
            'mobile' => ['required'],
            'privacy' => ['accepted']
        ];

        if ($this->type_person === 'pf') {
            $rules = array_merge($rules, [
                'cpf' => [
                    'required',
                    'cpf',
                    'formato_cpf',
                    'unique:contacts,cpf',
                    Rule::unique('contacts')->ignore($this->customer),
                ]
            ]);
        } elseif ($this->type_person === 'pj') {
            $rules = array_merge($rules, [
                'cnpj' => [
                    'required',
                    'cnpj',
                    'formato_cnpj',
                    Rule::unique('contacts')->ignore($this->customer),
                ],

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
            'accepted' => 'Concorde com os termos de uso'
        ];
    }
}
