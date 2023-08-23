<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantesFormRequest extends FormRequest
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
            'ala' => ['required', 'min:5', 'max:30'],
            'dataNascimento' => ['required','before:08/17/2007','after:08/17/1992']
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
            'ala' => [
                'required' => 'O campo Ala é obrigatório',
                'min' => 'O campo Ala precisa de no mínimo :min caracteres',
                'max' => 'O campo Ala precisa de no mínimo :max caracteres'
            ],
            'dataNascimento' => [
                'required' => 'O campo Data de Nascimento é obrigatório',
                'before' => 'Precisa ter pelo menos 17 anos',
                'after' => 'Precisa ter até 30 anos'
            ]
        ];
    }
}
