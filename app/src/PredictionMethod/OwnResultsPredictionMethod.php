<?php
namespace App\PredictionMethod;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\PredictionMethod\PredictionMethod;
use App\Service\PlayerService;

class OwnResultsPredictionMethod extends PredictionMethod
{

    private $playerService;
    
    public function __construct(Match $match, PlayerService $playerService)
    {
        parent::__construct($match);
        
        $this->playerService = $playerService;
    }
    
    public function predict(): HeroCollection
    {
        $favoriteHeroCollection = $this->playerService->getFavoriteHeroes($this->match);
        
        return \HeroCollectionHelper::toPredictedCollection($favoriteHeroCollection, $this, $this->match);
    }
}
