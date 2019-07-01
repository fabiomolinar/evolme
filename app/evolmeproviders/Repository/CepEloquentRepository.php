<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 8/30/16
 * Time: 5:43 PM
 */

namespace Evolme\EvolmeProviders\Repository;


use Canducci\Cep\Facades\Cep;
use Evolme\Http\Requests\Request;

class CepEloquentRepository
{
    /**
     *
     *We dont have a Cep model, so we use the Cep facade.
     *
     **/
    protected $cep;

    /**
     * CepEloquentRepository constructor.
     * @param Cep $cep
     */
    public function __construct(Cep $cep)
    {
        $this->cep = $cep;
    }

    public function getAddressByCep($cep){
        $zipCodeInfo = Cep::find($cep);
        return $zipCodeInfo->toJson();
    }
}