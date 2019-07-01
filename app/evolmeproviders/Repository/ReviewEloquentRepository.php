<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/22/16
 * Time: 4:29 PM
 */

namespace Evolme\EvolmeProviders\Repository;

use Evolme\Review;

class ReviewEloquentRepository
{

    /**
     *
     *The review model.
     *
     **/
    protected $review;

    /**
     *
     *Create new review
     * @param Review $review
     * @return void
     *
     **/
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

}