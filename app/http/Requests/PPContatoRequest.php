<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class PPContatoRequest extends Request
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
            'nome' => 'required|min:3|max:255',
            'estabelecimento' => 'required|min:3',
            'email' => 'required|email|max:255',
            'telefone' => 'required|numeric|min:7',
            'mensagem' => 'min:10'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Hum... Parece que você não digitou seu nome',
            'nome.min' => 'Hum... O nome parece curto demais, ele está correto?',
            'nome.max' => 'O campo nome excedeu o limite de caracteres',
            'email.email' => 'Hum... Acho que este não é um endereço válido. Que tal tentar algo no formato avaliador@evolme.com?',
            'email.required' => 'Hum... Parece que você não digitou seu email',
            'email.max' => 'O campo email excedeu o limite de caracteres',
            'telefone.required' => 'O campo telefone é obrigatório',
            'telefone.numeric' => 'O campo telefone precisa ser um número',
            'telefone.min' => 'O campo telefone precisa ser maior',
            'mensagem.min' => 'O campo mensagem precisa ser maior.'
        ];
    }
}
