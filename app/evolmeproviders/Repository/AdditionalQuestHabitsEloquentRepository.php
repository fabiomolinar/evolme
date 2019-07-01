<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/23/16
 * Time: 10:10 AM
 */

namespace Evolme\EvolmeProviders\Repository;


use Evolme\AdditionalQuestHabits;

class AdditionalQuestHabitsEloquentRepository
{
    /**
     *
     *The additional quest model.
     *
     **/
    protected $additional_quest_habit;

    /**
     *
     *Create new addional_quest
     * @param AdditionalQuestHabits $additional_quest_habit
     *
     **/
    public function __construct(AdditionalQuestHabits $additional_quest_habit)
    {
        $this->additional_quest_habit = $additional_quest_habit;
    }
}