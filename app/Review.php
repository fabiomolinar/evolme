<?php

namespace Evolme;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quality_score',
        'price_score',
        'customerservice_score',
        'waitingtime_score',
        'organization_id',
        'user_id',
        'comment'
    ];

    /**
     *
     * Returning the organization a review belongs to.
     *
     */
    public function organization(){
        return $this->belongsTo('Evolme\Organization','organization_id');
    }

    /**
     *
     * Returning the user a review belongs to.
     *
     */
    public function user(){
        return $this->belongsTo('Evolme\User','user_id');
    }

    /**
     *
     * Returning all reviews.
     *
     */
    public function reviews(){
        return $this->all();
    }

}
