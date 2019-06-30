<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\PredictedHeroCollection;
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
    
    public function removeBannedHeroesFromPrediction(PredictedHeroCollection $heroCollection): PredictedHeroCollection
    {
        foreach ($this->match->getBannedHeroes()->getHeroes() as $bannedHero) {
            $heroCollection->removeHero($bannedHero);
        }
    }

}
