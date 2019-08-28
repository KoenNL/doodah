<?php
namespace App\PredictionMethod;

use App\Document\Match;
use App\Document\PredictionCollection;

abstract class PredictionMethod
{

    public function getMethodName(): string
    {
        return get_class($this);
    }
    
    abstract public function predict(Match $match): PredictionCollection;
}
