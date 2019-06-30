<?php
namespace App\PerdictionMethod;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\PerdictionMethod\PerdictionMethod;
use App\Service\PlayerService;

class OwnResultsPerdictionMethod extends PerdictionMethod
{

    private $playerService;
    
    public function __construct(Match $match, PlayerService $playerService)
    {
        parent::__construct($match);
        
        $this->playerService = $playerService;
    }
    
    public function perdict(): HeroCollection
    {
        $favoriteHeroCollection = $this->playerService->getFavoriteHeroes($this->match);
        
        return \HeroCollectionHelper::toPerdictedCollection($favoriteHeroCollection, $this, $this->match);
    }
}
