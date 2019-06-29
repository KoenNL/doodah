<?php
namespace App\Transformer;

use App\Entity\HeroCollection;

class HeroCollectionTransformer
{

    /**
     * 
     * @param HeroCollection $heroCollection
     * @return array
     */
    public static function toIds(HeroCollection $heroCollection): array {
        $idArray = [];
        
        foreach ($heroCollection->getHeroes() as $hero) {
            $idArray[] = $hero->getId();
        }
        
        return $idArray;
    }
    
}
