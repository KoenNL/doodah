<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Entity\HeroMatchUpCollection;
use App\Exception\EndpointNotAvailableException;
use App\Exception\TooManyHeroesException;
use App\Transformer\HeroMatchupTransformer;
use App\Transformer\HeroTransformer;

class HeroService extends OpenDotaApiService
{

    private $heroes;

    public function __construct(HeroTransformer $transformer)
    {
        parent::__construct($transformer);
    }

    /**
     * @return HeroCollection
     * @throws EndpointNotAvailableException
     * @throws TooManyHeroesException
     */
    public function getHeroes(): HeroCollection
    {
        if (empty($this->heroes)) {
            $this->heroes = new HeroCollection();
            $heroTransformer = new HeroTransformer();
            foreach ($this->doRequest(parent::URI_GET_HEROES) as $hero) {
                $this->heroes->addHero($heroTransformer->transform($hero));
            }
        }

        return $this->heroes;
    }

    /**
     * @param int $heroId
     * @return HeroMatchUpCollection
     * @throws EndpointNotAvailableException
     * @throws TooManyHeroesException
     */
    public function getHeroMatchUps(int $heroId): HeroMatchUpCollection
    {
        $heroMatchUpCollection = new HeroMatchUpCollection($this->getHeroes()->getHeroById($heroId));
        $heroMatchUpTransformer = new HeroMatchupTransformer($this->getHeroes(), $heroId);

        foreach ($this->doRequest(parent::URI_GET_HERO_MATCHUPS, $heroId) as $heroMatchup) {
            $heroMatchUpCollection->addHeroMatchUp($heroMatchUpTransformer->transform($heroMatchup));
        }

        return $heroMatchUpCollection;
    }
}
