<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUpdateContactAddressRequest extends FormRequest
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
            'title' => ['required'],
            'cep' => ['required', 'regex:/^[0-9]{5}\-[0-9]{3}$/'],
            'address' => ['required'],
            'number' => ['required'],
            'neighborhood' => ['required'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'cep.regex' => 'Formato de CEP inválido',

        ];
    }

}
