<?php

namespace Evolme;

use Illuminate\Database\Eloquent\Model;

class AdditionalQuestFreq extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'additional_quest_freqs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'organization_id',
        'freq_us_score',
        'freq_first_time',
        'freq_geral_score',
    ];

    /**
     *
     * Returning an organization.
     *
     */
    public function organization(){
        return $this->belongsTo('Evolme\Organization','organization_id');
    }

    /**
     *
     * Returning a user.
     *
     */
    public function organization_address(){
        return $this->belongsTo('Evolme\User','user_id');
    }
}
