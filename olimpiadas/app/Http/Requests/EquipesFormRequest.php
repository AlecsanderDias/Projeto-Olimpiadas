<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipesFormRequest extends FormRequest
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
            'nome' => ['required', 'min:3', 'max:50'],
            // 'capitao' => ['nullable','integer','gt:0'],
            // 'pontuacao' => ['nullable','integer','gt:0']
        ];
    }

    public function messages()
    {
        return [
            'nome' => [
                'required' => 'O campo nome é obrigatório',
                'min' => 'O campo nome precisa de no mínimo :min caracteres',
                'max' => 'O campo nome precisa de no mínimo :max caracteres'
            ]
        ];
    }
}
