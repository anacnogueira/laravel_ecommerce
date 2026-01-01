<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SendContactRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'requemailired' => 'O campo deve ser um e-mail válido',
        ];
    }

}
