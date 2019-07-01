<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class AdicionarEstabelecimentoRequest extends Request
{
  /* Essa request serve para os estabelecimentos que o próprio dono está querendo adicionar a sua conta!!! */

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
            'estabelecimento' => 'required|min:3|max:255',
            'cidade' => 'required|max:255',
            'telefone' => 'required|min:7|numeric'
        ];
    }

    public function messages()
    {
        return [
            'estabelecimento.required' => 'O campo estabelecimento é obrigatório',
            'estabelecimento.min' => 'O campo estabelecimento precisa ser maior',
            'estabelecimento.max' => 'O campo estabelecimento excedeu o limite de caracteres',
            'cidade.required' => 'O campo cidade é obrigatório',
            'cidade.max' => 'O campo cidade excedeu o limite de caracteres',
            'telefone.required' => 'O campo telefone é obrigatório',
            'telefone.min' => 'O campo telefone precisa conter mais números',
            'telefone.numeric' => 'O campo telefone precisa conter apenas números'
        ];
    }
}
