<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampeonatosFormRequest extends FormRequest
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
            'nome' => ['required', 'min:5', 'max:50'],
            'quantidadeEquipes' => ['gt:1']
        ];
    }

    public function messages()
    {
        return [
            'nome' => [
                'required' => 'O campo Nome é obrigatório',
                'min' => 'O campo Nome precisa de no mínimo :min caracteres',
                'max' => 'O campo Nome precisa de no mínimo :max caracteres'
            ],
            'quantidadeEquipes' => [
                'gt' => 'O mínimo de equipes selecionadas é de dois'
            ]
        ];
    }
}
