<?php

namespace App\Entity;

use App\Entity\Hero;
use App\Entity\HeroMatchup;

class HeroMatchupCollection
{
    private $primaryHero;
    private $heroMatchups = [];

    public function __construct(Hero $primaryHero, array $heroMatchups = [])
    {
        $this->primaryHero = $primaryHero;
        $this->heroMatchups = $heroMatchups;
    }

    public function addHeroMatchup(HeroMatchup $heroMatchup): self
    {
        if (!$this->hasHeroMatchup($heroMatchup)) {
            $this->heroMatchups[] = $heroMatchup;
        }

        return $this;
    }

    public function getPrimaryHero(): Hero
    {
        return $this->primaryHero;
    }
    
    public function getHeroMatchups(): array
    {
        return $this->heroMatchups;
    }

    public function hasHeroMatchup(HeroMatchup $heroMatchup)
    {
        return in_array($heroMatchup, $this->heroMatchups);
    }
}
