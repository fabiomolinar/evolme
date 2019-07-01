<?php

namespace Evolme\Http\Controllers;

use Evolme\Organization;
use Illuminate\Http\Request;

use Evolme\Http\Requests;
use Evolme\Http\Controllers\Controller;
use Evolme\EvolmeProviders\Repository\OrganizationEloquentRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class OrganizationController extends Controller
{
    /**
     *
     *The organization repository.
     *
     **/
    protected $orgRepo;
    protected $gate;
    /**
     *
     *Create new user
     * @param OrganizationEloquentRepository $organization
     *
     **/
    
    public function __construct(OrganizationEloquentRepository $orgRepo)
    {
        $this->orgRepo = $orgRepo;
    }

    public function dashboard($organization){

        auth()->loginUsingId(2);
        return $organization;

        if(Gate::allows('dashboard',$organization)){
            return $organization;
        }else{
            return auth()->user();
        }
    }

}
