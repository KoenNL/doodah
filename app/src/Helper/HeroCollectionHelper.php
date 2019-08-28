<?php
namespace App\Helper;

use App\Document\HeroCollection;

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
}
