<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateContactNewsletterRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('contact_newsletters')->ignore($this->newsletter)
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'email' => 'Formato de e-mail inválido',
            'unique' => 'E-mail já cadastrado',

        ];
    }

}
