<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'upload' => ['file', 'image', 'mimes: jpeg,png,jpg,gif', 'max:2000'],
        ];
    }

    public function messages()
    {
        return [
            'max' => 'O tamanho do arquivo não deve exceder 2MB.',
        ];
    }

}
