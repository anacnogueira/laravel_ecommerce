<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'mobile' => ['required'],
        ];

        if ($this->type_person === 'pf') {
            $rules = array_merge($rules, [
                'name' => ['required'],
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
