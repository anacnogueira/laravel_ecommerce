<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'contact_address_id' => ['required', 'numeric'],
            'type_shipping' => ['required', 'string'],
            'payment_method_id' => ['required', 'numeric']
        ];

        if($this->payment_method_id == 1) { //creditCard
             $rules = array_merge($rules, [
                'card_number' => ['required'],
                'card_cvv' => ['required'],
                'card_expiration_month' => ['required'],
                'card_expiration_year' => ['required'],
                'installment_quantity' => ['required'],
                'creditCard_holder_name' => ['required'],
                'creditCard_holder_email' => ['required', 'email'],
                'creditCard_holder_cpf' => ['required','cpf','formato_cpf'],
                'creditCard_holder_area_code' => ['required'],
                'creditCard_holder_phone' => ['required'],
                'creditCard_holder_birth_date' => ['required'],
                'creditCard_token' => ['required'],
                'creditCard_brand' => ['required'],
             ]);

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required.contact_address_id' => 'Informe o endereço de entrega',
            'required.shipping' => 'Informe o tipo de entrega',
            'required.payment_method_id' => 'Informe o método de pagamento',
            'card_number.required' => 'Informe o número do cartão',
            'card_cvv.required' => 'Informe o código de segurança',
            'card_expiration_month.required' => 'Informe o mês de validade',
            'card_expiration_year.required' => 'Informe o ano de validade',
            'installment_quantity.required' => 'Informe a quantidade de parcelas',
            'creditCard_token.required' => 'Cartão de crédito inválido',
            'creditCardBrand.required' => 'Bandeira do cartão de crédito inválida',
            'creditCard_holder_name.required' => 'Informe o nome do titular do cartão',
            'creditCard_holder_email.required' => 'Informe o e-mail do titular do cartão',
            'creditCard_holder_cpf.required' => 'Informe o CPF do titular do cartão',
            'creditCard_holder_area_code.required' => 'Informe o DDD do titular do cartão',
            'creditCard_holder_phone.required' => 'Informe o telefone do titular do cartão',
            'creditCard_holder_birth_date.required' => 'Informe a data de nascimento do titular do cartão',
            'email' => 'Formato de e-mail inválido',
        ];
    }
}
