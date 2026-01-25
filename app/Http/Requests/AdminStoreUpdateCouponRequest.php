<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUpdateCouponRequest extends FormRequest
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
            'code' => ['required'],
            'discount_type' => ['required', 'in:percent,fixed'],
            'discount_amount' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'in' => 'Selecione o tipo de desconto'
        ];
    }

}
