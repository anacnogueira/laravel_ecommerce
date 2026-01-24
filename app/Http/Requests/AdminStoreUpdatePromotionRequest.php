<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUpdatePromotionRequest extends FormRequest
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
            'price_promotion' => ['required','numeric','gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'gt' => 'O valor do preço promocional deve ser maior que 0'
        ];
    }

}
