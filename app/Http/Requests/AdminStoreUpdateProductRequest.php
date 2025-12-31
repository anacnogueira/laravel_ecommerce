<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStoreUpdateProductRequest extends FormRequest
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
            'code' => ['required', Rule::unique('products')->ignore($this->product)],
            'contact_id' => ['required', 'gt:0'],
            'brand_id' => ['required', 'gt:0'],
            'origin' => ['required'],
            'name' => ['required'],
            'category_id' => ['required'],
            'selling_price' => ['required'],
            //'permalink' => ['required'],
            'status' => ['required', 'in:S,N'],
        ];
    }

    public function messages()
    {
        return [
            'contact_id.required' => 'O campo fornecedor é obrigatório',
            'brand_id.required' => 'O campo marca é obrigatório',
            'origin.required' => 'O campo origem  é obrigatório',
            'name.required' => 'O campo nome é obrigatório',
            'category_id.required' => 'O campo categoria é obrigatório',
            'selling_price.required' => 'O campo preço de venda é obrigatório',
        ];
    }
}
