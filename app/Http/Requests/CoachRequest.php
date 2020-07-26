<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoachRequest extends FormRequest
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
            'name'         => 'required|string',
            'age'          => 'required|numeric',
            'club_id'      => 'required|numeric|exists:clubs,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Informe o nome do Treinador!',
            'age.required'      => 'Informe a idade do Treinador!',
            'club_id.required'  => 'Informe o clube do Treinador!',
        ];
    }
}
