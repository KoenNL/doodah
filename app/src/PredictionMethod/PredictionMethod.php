<?php
namespace App\PredictionMethod;

use App\Entity\Match;
use App\Entity\PredictionCollection;

abstract class PredictionMethod
{

    public function getMethodName(): string
    {
        return get_class($this);
    }
    
    abstract public function predict(Match $match): PredictionCollection;
}
