<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayerRequest extends FormRequest
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
            'fullName'     => 'required|string',
            'name'         => 'required|string',
            'age'          => 'required|numeric',
            'position'     => 'required|string',
            'number'       => 'required|numeric',
            'club_id'      => 'required|numeric|exists:clubs,id',
            'status' => [
                'required',
                Rule::in(['Disponivel', 'Suspenso', 'Lesionado'])
            ]
        ];
    }
    public function messages()
    {
        return [
            'fullName.required' => 'Informe o nome completo do jogador!',
            'name.required'     => 'Informe o nome do jogador!',
            'age.required'      => 'Informe a idade do jogador!',
            'position.required' => 'Informe a posição do jogador!',
            'number.required'   => 'Informe o número do jogador!',
            'club_id.required'  => 'Informe o clube do jogador!',
            'status.required'   => 'Informe o status do jogador!'
        ];
    }
}
