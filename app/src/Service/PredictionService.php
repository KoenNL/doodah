<?php
namespace App\Service;

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
    
    public function predict(): PredictionCollection
    {
        return $this->predictionMethod->predict($this->match);
    }
    
    public function removeBannedHeroesFromPrediction(PredictionCollection $predictionCollection): PredictionCollection
    {
        foreach ($this->match->getBannedHeroes()->getHeroes() as $bannedHero) {
            $predictionCollection->removePredictionByHero($bannedHero);
        }

        return $predictionCollection;
    }

}
