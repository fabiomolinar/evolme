<?php

namespace Evolme;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'site',
        'twitter',
        'facebook',
        'phone',
        'provider_address',
        'cnpj',
        'user_id',
        'zip',
        'state',
        'city',
        'is_verified',
        'latitude',
        'longitude'
    ];

    /**
     *
     * Returning the list of owners.
     *
     */
    public function users(){
        return $this->belongsToMany('Evolme\User');
    }

    public function users_ids(){
        return $this->users()->lists('user_id');

    }

    /**
     *
     * Returning the reviews an organization has.
     *
     */
    public function reviews(){
        return $this->hasMany('Evolme\Review','organization_id');
    }

    /**
     *
     * Returning the NPS reviews an organization has.
     *
     */
    public function nps_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestNps','organization_id');
    }

    /**
     *
     * Returning the Freq reviews an organization has.
     *
     */
    public function freq_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestFreq','organization_id');
    }

    /**
     *
     * Returning the comparison reviews an organization has.
     *
     */
    public function habit_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestComparison','organization_id');
    }

    /**
     *
     * Returning the photos.
     *
     */
    public function photos(){
        return $this->morphMany('Evolme\Photo','imageable');
    }

}
