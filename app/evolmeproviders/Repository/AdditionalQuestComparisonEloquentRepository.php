<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/23/16
 * Time: 10:31 AM
 */

namespace Evolme\Repository;


use Evolme\AdditionalQuestComparison;

class AdditionalQuestComparisonEloquentRepository
{
    /**
     *
     *The additional quest model.
     *
     **/
    protected $additional_quest_comparison;

    /**
     *
     *Create new addional_quest
     * @param AdditionalQuestComparison $additional_quest_comparison
     *
     **/
    public function __construct(AdditionalQuestComparison $additional_quest_comparison)
    {
        $this->additional_quest_comparison = $additional_quest_comparison;
    }
}