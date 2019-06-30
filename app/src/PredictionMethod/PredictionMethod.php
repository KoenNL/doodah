<?php
namespace App\PredictionMethod;

abstract class PredictionMethod
{
    
    protected $match;
    
    function __construct(Match $match)
    {
        $this->match = $match;
    }
    
    function getMatch()
    {
        return $this->match;
    }

    public function __toString()
    {
        return get_class($this);
    }
    
    abstract public function predict();
}
