<?php
namespace App\Helper;

use App\Document\HeroCollection;
use App\Exception\InvalidHeroIdException;
use App\Exception\TooManyHeroesException;

class HeroCollectionHelper
{

    /**
     * @param HeroCollection $heroCollection
     * @param array $ids
     * @param bool $strict
     * @return HeroCollection
     * @throws InvalidHeroIdException
     * @throws TooManyHeroesException
     */
    public static function getHeroesByIds(HeroCollection $heroCollection, array $ids, bool $strict = true): HeroCollection
    {
        $newHeroCollection = new HeroCollection();

        foreach ($ids as $id) {
            $hero = $heroCollection->getHeroById($id);

            if ($strict === true && empty($hero)) {
                throw new InvalidHeroIdException($id);
            }
            $newHeroCollection->addHero($hero);
        }

        return $newHeroCollection;
    }
}
