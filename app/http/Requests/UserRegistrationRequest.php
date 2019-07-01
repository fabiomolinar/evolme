<?php

namespace Evolme\Http\Requests;

use Evolme\Http\Requests\Request;

class UserRegistrationRequest extends Request
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
            'name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users|confirmed',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Hum... Parece que você não digitou seu nome',
            'name.min' => 'Hum... O nome parece curto demais, ele está correto?',
            'last_name.required' => 'Hum... Parece que você não digitou seu sobrenome',
            'last_name.min' => 'Hum... O sobrenome parece curto demais, ele está correto?',
            'email.email' => 'Hum... Acho que este não é um endereço válido. Que tal tentar algo no formato avaliador@evolme.com?',
            'email.required' => 'Hum... Parece que você não digitou seu email',
            'email.unique' => 'Hum... Esse email já está registrado em nossa base, caso tenha esquecido sua senha clique no link "Esqueci minha senha"',
            'email.confirmed' => 'Hum... Vamos conferir se a informação digitada está igual ao informado acima?',
            'password.required' => 'Hum... Parece que você não digitou uma senha. Lembrando que ela deve conter pelo menos 6 caracteres.',
            'password.min' => 'Hum... Esta senha é curta de mais. Para sua segurança, sua senha deve possuir pelo menos 6 caracteres',
            'password.confirmed' => 'Vamos conferir se a informação digitada está igual ao informado acima?',
            'g-recaptcha-response.required' => 'Por favor, informe-nos se você não é um robô.'
        ];
    }
}
