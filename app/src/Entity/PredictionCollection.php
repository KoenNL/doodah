<?php
namespace App\Entity;

use App\Exception\PositionOccupiedException;
use App\PredictionMethod\PredictionMethod;

class PredictionCollection
{

    private $predictionMethod;
    private $match;
    private $predictions = [];

    /**
     * @param PredictionMethod $predictionMethod
     * @param Match $match
     * @param array $predictions
     * @throws PositionOccupiedException
     */
    function __construct(PredictionMethod $predictionMethod, Match $match, array $predictions = [])
    {
        $this->predictionMethod = $predictionMethod;
        $this->match = $match;
        
        foreach ($predictions as $prediction) {
            $this->addPrediction($prediction, false);
        }
    }

    /**
     * Add a prediction to the collection. By default sets it at the given position if available.
     * @param Prediction $prediction
     * @param bool $respectPosition
     * @throws PositionOccupiedException
     */
    public function addPrediction(Prediction $prediction, bool $respectPosition = true)
    {
        if (!empty($this->predictions[$prediction->getPosition()]) && $respectPosition) {
            throw new PositionOccupiedException($prediction->getPosition());
        } elseif ($respectPosition) {
            $this->predictions[$prediction->getPosition()] = $prediction;
        } else {
            $this->predictions[] = $prediction;
        }
    }
    
    /**
     * 
     * @return PredictionMethod
     */
    public function getPredictionMethod(): PredictionMethod
    {
        return $this->predictionMethod;
    }

    /**
     * 
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }
    
    /**
     * @return array
     */
    public function getPredictions(): array
    {
        return $this->predictions;
    }
    
    /**
     * 
     * @param Prediction $predictionToBeRemoved
     * @return \self
     */
    public function removePrediction(Prediction $predictionToBeRemoved): self
    {
        unset($this->predictions[array_search($predictionToBeRemoved, $this->predictions)]);
        
        return $this;
    }
    
    /**
     * 
     * @param Hero $hero
     * @return self
     */
    public function removePredictionByHero(Hero $hero): self
    {
        foreach ($this->predictions as $key => $prediction) {
            if ($prediction->getHero() === $hero) {
                unset($this->predictions[$key]);
            }
        }
        
        return $this;
    }

    /**
     * Sort this collection of predictions.
     * @throws PositionOccupiedException
     */
    public function sort()
    {
        $unsortedPrediction = $this->predictions;
        $this->predictions = [];
        
        foreach ($unsortedPrediction as $prediction) {
            $this->addPrediction($prediction);
        }
    }
}
