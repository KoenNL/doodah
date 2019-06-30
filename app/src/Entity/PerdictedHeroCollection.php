<?php
namespace App\Entity;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\PerdictionMethod\PerdictionMethod;

class PerdictedHeroCollection extends HeroCollection
{

    private $perdictionMethod;
    private $match;

    function __construct(PerdictionMethod $perdictionMethod, Match $match, array $heroes = [])
    {
        parent::__construct($heroes);

        $this->perdictionMethod = $perdictionMethod;
        $this->match = $match;
    }

    public function addHero(PerdictedHero $hero)
    {
        parent::addHero($hero);
    }
    
    function getPerdictionMethod()
    {
        return $this->perdictionMethod;
    }

    function getMatch()
    {
        return $this->match;
    }
}
