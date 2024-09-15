<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUpdateUserRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'between:6,15'],
            'user_group_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'email' => 'Formato de e-mail inválido',
            'unique' => 'Esse e-mail já está sendo utilizado',
            'between' => 'A senha deve ter entre 6 e 15 caracteres.',
            'confirmed' =>  'A confirmação da senha não corresponde.',
        ];
    }

}
