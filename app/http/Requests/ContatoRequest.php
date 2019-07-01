<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class ContatoRequest extends Request
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
            'email' => 'required|email|max:255',
            'mensagem' => 'required|min:10'
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
            'mensagem.required' => 'Você precisa deixar uma mensagem.',
            'mensagem.min' => 'O campo mensagem precisa ser maior.'
        ];
    }
}
