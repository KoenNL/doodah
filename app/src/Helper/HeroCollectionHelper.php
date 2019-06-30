<?php
namespace App\Helper;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\PerdictedHero;
use App\Entity\PerdictedHeroCollection;
use App\PerdictionMethod\PerdictionMethod;

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
    
    public static function toPerdictedCollection(HeroCollection $heroCollection, PerdictionMethod $perdictionMethod, Match $match): PerdictedHeroCollection
    {
        $perdictedHeroCollection = new PerdictedHeroCollection($perdictionMethod, $match);
        
        foreach ($heroCollection->getHeroes() as $position => $hero) {
            $perdictedHeroCollection->addHero(
                new PerdictedHero(
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
        
        return $perdictedHeroCollection;
    }
}
