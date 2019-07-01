<?php

namespace Evolme\Http\Controllers;

use Illuminate\Http\Request;

use Evolme\Http\Requests;
use Evolme\Http\Controllers\Controller;
use Evolme\EvolmeProviders\Repository\CepEloquentRepository;

class CepController extends Controller
{
    /**
     * The cepRepository
     */
    protected $cepRepository;

    public function __construct(CepEloquentRepository $cepRepository)
    {
        $this->cepRepository = $cepRepository;
    }

    public function getAddressByCep(Request $request){
        $address = $this->cepRepository->getAddressByCep($request->input("cep"))->result();
        echo json_encode($address);
    }

}
