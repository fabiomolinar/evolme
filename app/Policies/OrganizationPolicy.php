<?php

namespace Evolme\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Evolme\Organization;
use Evolme\User;

class OrganizationPolicy
{
    use HandlesAuthorization;

    private $orgRepo;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Defining the method that checks for admins.
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before($user,$ability){
        if($user->role_id == 2){
            return true;
        }
    }

    public function dashboard(User $user,Organization $organization){
        return in_array($user->id,$organization->users_ids()->toArray());
    }


}
