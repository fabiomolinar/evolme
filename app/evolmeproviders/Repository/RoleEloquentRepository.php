<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 5/21/16
 * Time: 5:10 PM
 */

namespace Evolme\EvolmeProviders\Repository;

use Evolme\Roles;



class RoleEloquentRepository
{
    /**
     *
     *The user model.
     *
     **/
    protected $role;

    /**
     *
     *Create new user
     * @param Roles $role
     * @return void
     *
     **/
    public function __construct(Roles $role)
    {
        $this->user = $role;
    }
}