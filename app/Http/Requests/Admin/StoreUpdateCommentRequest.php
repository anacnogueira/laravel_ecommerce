<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCommentRequest extends FormRequest
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
            'product_id' => ['required'],
            'rate' => ['required', 'numeric'],
            'name' => ['required'],
            'email' => ['required','email'],
            'text' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
        ];
    }

}
