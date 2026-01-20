<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateOrderRequest extends FormRequest
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
            'type' => ['required','in:order,log'],
        ];

        if ($this->type === 'order') {
            $rules = array_merge($rules, [
                'tracking_code' => ['required'],
            ]);
        } elseif ($this->type === 'log') {
            $rules = array_merge($rules, [
                'order_status_id' => ['required'],

            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
        ];
    }
}
