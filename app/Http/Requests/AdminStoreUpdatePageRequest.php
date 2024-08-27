<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUpdatePageRequest extends FormRequest
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
            'content' => ['required'],
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
