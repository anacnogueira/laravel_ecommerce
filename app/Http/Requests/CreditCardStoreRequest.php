<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreditCardStoreRequest extends FormRequest
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
            'items' => ['array', 'required'],
            'items.*.name' => ['required'],
            'items.*.amount' => ['required'],
            'items.*.value' => ['required'],
            'shippings' => ['array', 'required'],
            'shippings.*.name' => ['required'],
            'shippings.*.value' => ['required'],
            'order_id' => ['required', 'numeric'],
            'name' => 'required', //To do: Validação CPF
            'cpf' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birth' => 'required',
            'payment_token' => 'required',
            'installments' => 'required',
            'billing_address' => ['array', 'required'],
            'billing_address.street' => 'required',
            'billing_address.number' => 'required',
            'billing_address.neighborhood' => 'required',
            'billing_address.zipcode' => 'required',
            'billing_address.city' => 'required',
            'billing_address.state' => 'required',

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
