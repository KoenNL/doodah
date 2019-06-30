<?php
namespace App\Entity;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\PredictionMethod\PredictionMethod;

class PredictedHeroCollection extends HeroCollection
{

    private $predictionMethod;
    private $match;

    function __construct(PredictionMethod $predictionMethod, Match $match, array $heroes = [])
    {
        parent::__construct($heroes);

        $this->predictionMethod = $predictionMethod;
        $this->match = $match;
    }

    public function addHero(PredictedHero $hero)
    {
        parent::addHero($hero);
    }
    
    function getPredictionMethod()
    {
        return $this->predictionMethod;
    }

    function getMatch()
    {
        return $this->match;
    }
    
    public function removeHero(PredictedHero $predictiedHero)
    {
        parent::removeHero($predictiedHero);
    }
}
