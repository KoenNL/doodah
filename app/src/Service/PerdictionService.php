<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\PerdictionMethod\PerdictionMethod;

class PerdictionService
{
    
    private $match;
    private $perdictionMethod;
    
    function __construct(Match $match, PerdictionMethod $perdictionMethod)
    {
        $this->match = $match;
        $this->perdictionMethod = $perdictionMethod;
    }
    
    public function perdict(): HeroCollection
    {
        return $this->perdictionMethod->perdict();
    }

}
