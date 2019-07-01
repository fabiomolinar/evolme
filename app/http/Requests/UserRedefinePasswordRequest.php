<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class UserRedefinePasswordRequest extends Request
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
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Houve um problema na identificação do seu token. Por favor, tente novamente.',
            'email.email' => 'Hum... Acho que este não é um endereço válido. Que tal tentar algo no formato avaliador@evolme.com?',
            'email.required' => 'Hum... Parece que você não digitou seu email',
            'password.required' => 'Hum... Parece que você não digitou uma senha. Lembrando que ela deve conter pelo menos 6 caracteres.',
            'password.min' => 'Hum... Esta senha é curta de mais. Para sua segurança, sua senha deve possuir pelo menos 6 caracteres',
            'password.confirmed' => 'Vamos conferir se a informação digitada está igual ao informado acima?',
        ];
    }
}
