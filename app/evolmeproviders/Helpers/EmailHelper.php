<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 5/22/16
 * Time: 1:56 PM
 */

namespace Evolme\EvolmeProviders\Helpers;

use Mail;

class EmailHelper
{
    public static function WelcomeMail($user){
        $textos = ['Olá, '.$user->name.'.',
            'Sou o Gabriel da evolme. Muito obrigado por se cadastrar na nossa plataforma.',
            'Você sabia que a evolme presenteia seus melhores avaliadores?',
            'Aproveite esse momento e comece já a avaliar os seus estabelecimentos prediletos. Para isso, basta buscá-los no link "buscar estabelecimento".',
            'Não deixe de curtir nossa fanpage: www.facebook.com/evolmebrasil',
            'Abraços.'];
        Mail::send('emails.layoutEmail',
            ['titulo'=>'Bem Vindo à Evolme','textos'=>$textos, 'nome'=>'Gabriel Viscondi','cargo'=> 'COO', 'email'=>'gabriel.viscondi@evolme.com','telefone'=> '','skype'=>''],
            function($message) use ($user){
                $message->from('gabriel.viscondi@evolme.com','Gabriel Viscondi');
                $message->to($user->email,$user->name)->subject('Bem vindo à evolme!');
            });
    }

    public static function ContactEmail($request){
        Mail::send('emails.contato', ['nome' => $request->nome,'email' => $request->email, 'mensagem'=>$request->mensagem,'telefone'=>$request->telefone],
            function ($message) {
                $message->from('evolme@evolme.com', 'Evolme');

                $message->to('contato@evolme.com')->subject('Formulário de Contato do Site');
            });
    }

    public static function PPContactEmail($request){
        Mail::send('emails.ppContato',['nome' => $request->nome,'email' => $request->email,'estabelecimento' => $request->estabelecimento, 'mensagem' => $request->mensagem, 'telefone' => $request->telefone],
            function($message){
                $message->from('evolme@evolme.com','Evolme');
                $message->to('contato@evolme.com')->subject('Formulário de Contato da Página de Planos e Preços');
            });
    }

    public static function PPCadastro($request){
        Mail::send('emails.ppCadastro',['nome' => $request->nome,'email' => $request->email,'estabelecimento' => $request->estabelecimento, 'cidade' => $request->cidade, 'telefone' => $request->telefone],
            function($message){
                $message->from('evolme@evolme.com','Evolme');
                $message->to('contato@evolme.com')->subject('Planos e Preços novo Cadastro');
            });
    }
}