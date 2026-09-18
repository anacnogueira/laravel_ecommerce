<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFaqRequest extends FormRequest
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

    protected function prepareForValidation(): void
    {
        $questionPlainText = strip_tags($this->input('question'));
        $answerPlainText = strip_tags($this->input('answer'));

        $questionCleanText = trim(html_entity_decode($questionPlainText, ENT_QUOTES, 'UTF-8'));
        $answerCleanText = trim(html_entity_decode($answerPlainText, ENT_QUOTES, 'UTF-8'));

        $this->merge([
            'question_pure_text' => $questionCleanText,
            'answer_pure_text' => $answerCleanText,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'question' => ['required', 'string'],
            'question_pure_text' => ['required', 'min: 10'],
            'answer' => ['required', 'string'],
            'answer_pure_text' => ['required', 'min: 10'],
            'order' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo é obrigatório',
        ];
    }

}
