<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class UserUpdateProfileRequest extends Request
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
            'name' => 'required|min:3',
            'nickname' => 'required|min:2',
            'zip' => 'required',
            'birth_date' => 'required',
            'state' => 'required',
            'city' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome não pode estar em branco',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'zip.required' => 'O cep deve ser preenchido.',
            'state.required' => 'Por favor, verifique o CEP para que o estado seja preenchido.',
            'city.required' => 'Por favor, verifique o CEP para que a cidade seja preenchida.'
        ];
    }
}
