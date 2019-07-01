<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/23/16
 * Time: 10:07 AM
 */

namespace Evolme\EvolmeProviders\Repository;


use Evolme\AdditionalQuestFreq;

class AdditionalQuestFreqEloquentRepository
{
    /**
     *
     *The additional quest model.
     *
     **/
    protected $additional_quest_freq;

    /**
     *
     *Create new addional_quest
     * @param AdditionalQuestFreq $additional_quest_freq
     *
     **/
    public function __construct(AdditionalQuestFreq $additional_quest_freq)
    {
        $this->additional_quest_freq = $additional_quest_freq;
    }
}