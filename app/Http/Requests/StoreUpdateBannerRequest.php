<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class StoreUpdateBannerRequest extends FormRequest
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
            'upload' => ['file', 'image', 'mimes: jpeg,png,jpg,gif', 'max:20248'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
            'image' => 'O arquivo deve ser uma imagem.',
            'mimes' => 'Os tipos de imagens suporttados são: jpeg, png, jpg, e gif.',
            'max' => 'O tamamanho do arquivo não deve exceder 2MB.',
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
