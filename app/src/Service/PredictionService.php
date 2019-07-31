<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\PredictionCollection;
use App\PredictionMethod\PredictionMethod;

class PredictionService
{
    
    private $match;
    private $predictionMethod;
    
    function __construct(Match $match, PredictionMethod $predictionMethod)
    {
        $this->match = $match;
        $this->predictionMethod = $predictionMethod;
    }
    
    public function predict(): HeroCollection
    {
        return $this->predictionMethod->predict();
    }
    
    public function removeBannedHeroesFromPrediction(PredictionCollection $predicionCollection): PredictionCollection
    {
        foreach ($this->match->getBannedHeroes()->getHeroes() as $bannedHero) {
            $predicionCollection->removeHero($bannedHero);
        }
    }

}
