<?php
namespace App\PredictionMethod;

use App\Entity\PredictionCollection;
use PHPUnit\Framework\MockObject\Builder\Match;

abstract class PredictionMethod
{

    public function getMethodName(): string
    {
        return get_class($this);
    }
    
    abstract public function predict(Match $match): PredictionCollection;
}
