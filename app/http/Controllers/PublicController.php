<?php

namespace Evolme\Http\Controllers;

use Evolme\EvolmeProviders\Helpers\EmailHelper;
use Evolme\EvolmeProviders\Repository\UserEloquentRepository;
use Illuminate\Http\Request;

use Evolme\Http\Requests;
use Evolme\Http\Controllers\Controller;
use Evolme\Http\Requests\ContatoRequest;
use Evolme\Http\Requests\PPContatoRequest;
use Evolme\Http\Requests\PlanosPrecosRequest;

class PublicController extends Controller
{
   protected $userRepo;

    /**
     *
     *Create new UserEloquentRepository
     * @param UserEloquentRepository $userRepo
     *
     **/
    public function __construct(UserEloquentRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

   public function home(){
       return view('publicas.home');
   }

   public function contato(){
       return view('publicas.contato');
   }

   public function postContato(ContatoRequest $request){
        EmailHelper::ContactEmail($request);
        echo json_encode(array("status" => "true","mensagem" => "Obrigado pelo seu contato. Assim que possível te daremos um retorno."));
   }

   public function sobre(){
       return view('publicas.sobre');
   }

    public function suporte(){
        return view('publicas.suporte');
    }

    public function trabalheConosco(){
        return view('publicas.trabalheConosco');
    }

    public function cadastro(){
        return view('auth.register');
    }

    public function login(){
        return view('auth.login');
    }

    public function planosEPrecos(){
            $planos = array(
                array(
                    'titulo' => 'evolme iniciante',
                    'descricao' => 'Comece a evoluir e tenha seu primeiro contato com nossa plataforma de gestão',
                    'incluso' => array(
                        'Análise de satisfação de clientes (NPS)',
                        'Análise quantitativa de qualidade geral',
                        'Análise de qualidade de atendimento',
                        'Análise de preço',
                        'Análise de tempo de espera',
                        '+1 questionário adicional',
                        'limite de 1 estabelecimento'
                    ),
                    'preco' => '98,00',
                    'ID' => 'plano1'
                ),
                array(
                    'titulo' => 'evolme profissional',
                    'descricao' => 'Tenha uma experiência ainda mais intensa de evolução com acesso à novos questionários',
                    'incluso' => array(
                        'Análise de satisfação de clientes (NPS)',
                        'Análise quantitativa de qualidade geral',
                        'Análise de qualidade de atendimento',
                        'Análise de preço',
                        'Análise de tempo de espera',
                        'Todos questionários adicionais',
                        'limite de 1 estabelecimento'
                    ),
                    'preco' => '198,00',
                    'ID' => 'plano2'
                ),
                array(
                    'titulo' => 'evolme especialista',
                    'descricao' => 'Usufrua da experiência evolme máxima e domine os interesses de seus clientes utilizando nossa ferramenta completa',
                    'incluso' => array(
                        'Análise de satisfação de clientes (NPS)',
                        'Análise quantitativa de qualidade geral',
                        'Análise de qualidade de atendimento',
                        'Análise de preço',
                        'Análise de tempo de espera',
                        'Todos questionários adicionais',
                        'limite de 2 estabelecimentos',
                        'Levantamento de problemas e soluções do time evolme'
                    ),
                    'preco' => '298,00',
                    'ID' => 'plano3'
                )
            );
        return view('publicas.planosEPrecos')->with('planos',$planos);
    }

    public function PPContato(PPContatoRequest $request){
        EmailHelper::PPContactEmail($request);
        echo json_encode(array("status" => "true","mensagem" => "Obrigado pelo seu contato. Assim que possível te daremos um retorno."));
    }

    public function postPlanosPrecos(PlanosPrecosRequest $request){
        $user = $this->userRepo->CreateFromPlanosEPrecos($request);
        $this->userRepo->AuthenticateUser($user);
        //EmailHelper::PPCadastro($request);
        echo json_encode(["status"=> true , "mensagem" => "Obrigado pelo seu interessa na evolme. Entraremos em contato em breve!!"]);

    }
}
