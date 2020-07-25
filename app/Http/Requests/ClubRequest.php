<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClubRequest extends FormRequest
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
            'abbreviation' => 'required|string',
            'color'        => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'fullName.required'     => 'Informe o nome completo do Time!',
            'name.required'         => 'Informe o nome do Time!',
            'abbreviation.required' => 'Informe a abreviação do Time!',
            'color.required'        => 'Informe a cor do Time!'
        ];
    }
}
