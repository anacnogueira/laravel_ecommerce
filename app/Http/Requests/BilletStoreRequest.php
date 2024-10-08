<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BilletStoreRequest extends FormRequest
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
