<?php
/**
 * Created by PhpStorm.
 * User: claudionor
 * Date: 4/23/16
 * Time: 9:24 AM
 */

namespace Evolme\EvolmeProviders\Repository;


use Evolme\AdditionalQuestNps;

class AdditionalQuestNpsEloquentRepository
{
    /**
     *
     *The additional quest model.
     *
     **/
    protected $additional_quest_nps;

    /**
     *
     *Create new addional_quest
     * @param AdditionalQuestNps $additional_quest_nps
     *
     **/
    public function __construct(AdditionalQuestNps $additional_quest_nps)
    {
        $this->additional_quest_nps = $additional_quest_nps;
    }
}