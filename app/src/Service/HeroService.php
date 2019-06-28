<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Entity\HeroMatchupCollection;
use App\Transformer\HeroMatchupTransformer;
use App\Transformer\HeroTransformer;

class HeroService extends OpenDotaApiService
{

    private $heroes;

    public function getHeroes(): HeroCollection
    {
        if (empty($this->heroes)) {
            $this->heroCollection = new HeroCollection();
            $heroTransformer = new HeroTransformer();
            foreach ($this->doRequest(parent::URI_GET_HEROES) as $hero) {
                $this->heroCollection->addHero($heroTransformer->transform($hero));
            }
        }

        return $this->heroCollection;
    }

    public function getHeroMatchups(int $heroId): HeroMatchupCollection
    {
        $heroMatchupCollection = new HeroMatchupCollection($this->getHeroes()->getHeroById($heroId));
        $heroMatchupTransformer = new HeroMatchupTransformer($this->getHeroes(), $heroId);

        foreach ($this->doRequest(parent::URI_GET_HERO_MATCHUPS, $heroId) as $heroMatchup) {
            $heroMatchupCollection->addHeroMatchup($heroMatchupTransformer->transform($heroMatchup));
        }

        return $heroMatchupCollection;
    }
}
