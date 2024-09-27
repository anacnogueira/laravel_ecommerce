<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStoreUpdateSupplierRequest extends FormRequest
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
            'fantasy_name' => ['required'],
            'cnpj' => [
                'required',
                Rule::unique('contacts')->ignore($this->contact),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->contact),
            ],    
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'image' => 'O arquivo deve ser uma imagem.',
            'mimes' => 'Os tipos de imagens suporttados são: jpeg, png, jpg, e gif.',
            'max' => 'O tamamanho do arquivo não deve exceder 2MB.',
        ];
    }

}
