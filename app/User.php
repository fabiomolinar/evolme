<?php

namespace Evolme;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword,Authorizable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'nickname',
        'zip',
        'state',
        'city',
        'role_id',
        'notification',
        'birth_date',
        'birth_date_update_at',
        'gender',
        'monthly_income',
        'monthly_income_update_at',
        'marital_status',
        'marital_status_update_at',
        'email',
        'password',
        'password_confirmation',
        'provider',
        'provider_token',
        'provider_id',
        'avatar',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     *
     * Returning an array with the organizations a user owns.
     *
     */
    public function organizations(){
        return $this->belongsToMany('Evolme\Organization','user_id');
    }

    /**
     *
     * Returning the reviews a user has made.
     *
     */
    public function reviews(){
        return $this->hasMany('Evolme\Review','user_id');
    }

    /**
     *
     * Returning the NPS reviews a user has made.
     *
     */
    public function nps_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestNps','user_id');
    }

    /**
     *
     * Returning the Freq reviews a user has made.
     *
     */
    public function freq_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestFreq','user_id');
    }

    /**
     *
     * Returning the habit reviews a user has made.
     *
     */
    public function habit_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestHabits','user_id');
    }

    /**
     *
     * Returning the comparison reviews a user has made.
     *
     */
    public function comparison_reviews(){
        return $this->hasMany('Evolme\AdditionalQuestComparison','user_id');
    }

    /**
     *
     * Returning the role of a user
     *
     */
    public function roles(){
        return $this->belongsTo('Evolme\Roles','role_id');
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
