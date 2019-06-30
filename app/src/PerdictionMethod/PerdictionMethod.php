<?php
namespace App\PerdictionMethod;

abstract class PerdictionMethod
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
    
    abstract public function perdict();
}
