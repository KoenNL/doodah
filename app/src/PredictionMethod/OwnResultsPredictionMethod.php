<?php
namespace App\PredictionMethod;

use App\Document\Match;
use App\Document\Prediction;
use App\Document\PredictionCollection;
use App\Exception\EndpointNotAvailableException;
use App\Exception\PositionOccupiedException;
use App\Service\PlayerService;

class OwnResultsPredictionMethod extends PredictionMethod
{

    private $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * @param Match $match
     * @return PredictionCollection
     * @throws PositionOccupiedException
     * @throws EndpointNotAvailableException
     */
    public function predict(Match $match): PredictionCollection
    {
        $favoriteHeroCollection = $this->playerService->getFavoriteHeroes($match);

        $predictionCollection = new PredictionCollection($this, $match);

        foreach ($favoriteHeroCollection->getHeroes() as $position => $hero) {
            $predictionCollection->addPrediction(new Prediction($hero, $position));
        }

        return $predictionCollection;
    }
}
