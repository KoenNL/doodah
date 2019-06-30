<?php
namespace App\Helper;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\PredictedHero;
use App\Entity\PredictedHeroCollection;
use App\PredictionMethod\PredictionMethod;

class HeroCollectionHelper
{
    
    public static function getHeroesByIds(HeroCollection $heroCollection, array $ids): HeroCollection
    {
        $newHeroCollection = new HeroCollection();
        
        foreach ($ids as $id) {
            $newHeroCollection->addHero($heroCollection->getHeroById($id));
        }
        
        return $newHeroCollection;
    }
    
    public static function toPredictedCollection(HeroCollection $heroCollection, PredictionMethod $predictionMethod, Match $match): PredictedHeroCollection
    {
        $predictedHeroCollection = new PredictedHeroCollection($predictionMethod, $match);
        
        foreach ($heroCollection->getHeroes() as $position => $hero) {
            $predictedHeroCollection->addHero(
                new PredictedHero(
                    $hero->getId(), 
                    $hero->getName(), 
                    $hero->getLocalizedName(), 
                    $hero->getPrimaryAttribute(), 
                    $hero->getAttackType(), 
                    $hero->getRoles(), 
                    $hero->getLegs(), 
                    $position
                )
            );
        }
        
        return $predictedHeroCollection;
    }
}
