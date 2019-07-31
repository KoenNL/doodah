<?php
namespace App\PredictionMethod;

use App\Entity\Match;
use App\Entity\PredictionCollection;
use App\PredictionMethod\PredictionMethod;
use App\Service\PlayerService;

class OwnResultsPredictionMethod extends PredictionMethod
{

    private $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function predict(Match $match): PredictionCollection
    {
        $favoriteHeroCollection = $this->playerService->getFavoriteHeroes($this->match);

        $predictionCollection = new PredictionCollection($this, $match);

        foreach ($favoriteHeroCollection->getHeroes() as $position => $hero) {
            $predictionCollection->addPrediction(new Prediction($hero, $position));
        }

        return $predictionCollection;
    }
}
