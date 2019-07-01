<?php

namespace Evolme;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The Fillable array
     * @var  array
     */
    protected $fillable = [
        'path',
        'is_profile',
        'imageable_id',
        'imageable_type',
    ];

    public function imageable(){
        return $this->morphTo();
    }

}
