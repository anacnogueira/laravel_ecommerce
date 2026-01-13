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

        return [
            'name' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('contacts')->ignore($this->customer)
             ],
            'gender' => ['required'],
            'cpf' => [
                'required',
                'cpf',
                Rule::unique('contacts')->ignore($this->customer)
            ],
            'date_birth' => ['required'],
            'newsletter' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'email' => 'Formato de e-mail inválido',
            'email.unique' => 'E-mail já cadastrado',
            'cpf.unique' => 'CPF já cadastrado',
        ];
    }

}
