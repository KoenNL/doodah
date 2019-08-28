<?php
namespace App\Document;

class Prediction
{

    private $position;
    private $hero;
    
    function __construct(int $position, Hero $hero)
    {
        $this->position = $position;
        $this->hero = $hero;
    }
    
    function getPosition(): int
    {
        return $this->position;
    }

    function getHero(): Hero
    {
        return $this->hero;
    }

    function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    function setHero($hero)
    {
        $this->hero = $hero;
        return $this;
    }
}
