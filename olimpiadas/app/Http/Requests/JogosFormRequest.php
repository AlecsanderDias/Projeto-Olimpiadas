<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JogosFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'placarCasa' => ['integer','gt:-1'],
            'placarAdversario' => ['integer','gt:-1'],
        ];
    }

    public function messages()
    {
        return [
            'placarCasa' => [
                'integer' => 'O Placar Casa precisa ser um número inteiro',
                'gt' => 'O Placar Casa precisa ser 0 ou positivo'
            ],
            'placarAdversario' => [
                'integer' => 'O Placar Adversario precisa ser um número inteiro',
                'gt' => 'O Placar Adversario precisa ser 0 ou positivo'
            ],
        ];
    }
}
