<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUpdateCategoryRequest extends FormRequest
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
            'order' => ['required'],
            'permalink' => ['required'],
            'upload' => ['file', 'image', 'mimes: jpeg,png,jpg,gif', 'max:20248'],
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
