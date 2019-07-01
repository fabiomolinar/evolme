<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/22/16
 * Time: 3:47 PM
 */

namespace Evolme\EvolmeProviders\Repository;

use Evolme\Organization;

class OrganizationEloquentRepository
{
    /**
     *
     *The organization model.
     *
     **/
    protected $organization;
    /**
     *
     *Create new organization
     * @param Organization $organization
     *
     **/
    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    /**
     *
     * Returning the organization profile image.
     *
     */
    public function GetOrganizationProfilePhoto(){
        return $this->organization->photos()->where('is_profile',true);
    }

    /**
     *
     * Returning the organization images that are not the profile image.
     *
     */
    public function GetAllOrganizationPhotos(){
        return $this->organization->photos()->where('is_profile',false);
    }

    /**
     *
     * Returning an organization by its id.
     *
     */
    public function GetOrganizationById($id){
        return $this->organization->findOrFail($id);
    }

    /**
     *
     * Returning the reviews of an organization.
     *
     */
    public function GetOrganizationReviews(){
        return $this->organization->reviews();
    }

}