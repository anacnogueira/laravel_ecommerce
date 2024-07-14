<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBannerStoreRequest extends FormRequest
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
        //TO DO:
        // Validações de arquivo de upload
        
        return [
            'name' => ['required'],
            'upload' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
        ];
    }

}
