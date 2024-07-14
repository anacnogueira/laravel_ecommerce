<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PixGenerateChargeRequest extends FormRequest
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
            'cpf' => 'required', //To do: Validação CPF
            'name' => 'required',
            'amount' => ['required', 'numeric'],
            'order_id' => ['required', 'numeric']
        ];
    }

    public function messages()
    {
        return [
            'cpf.required' => 'Informe o cpf do devedor',
            'name.required' => 'Informe o nome do devedor',
            'amount.required' => 'Informe o valor total do pedido',
            'amount.numeric' => 'Valor total do pedido deve ser um valor numérico',
            'order_id.required' => 'Informe o id do pedido',
            'order_id.integer' => 'O campo id do pedido deve ser um valor numérico'
        ];
    }

    /**
     * Transform the error messages into JSON
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
