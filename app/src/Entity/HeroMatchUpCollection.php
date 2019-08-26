<?php
namespace App\Entity;

class HeroMatchUpCollection
{
    private $primaryHero;
    private $heroMatchUps = [];

    public function __construct(Hero $primaryHero, array $heroMatchUps = [])
    {
        $this->primaryHero = $primaryHero;
        $this->heroMatchUps = $heroMatchUps;
    }

    public function addHeroMatchUp(HeroMatchUp $heroMatchUp): self
    {
        if (!$this->hasHeroMatchUp($heroMatchUp)) {
            $this->heroMatchUps[] = $heroMatchUp;
        }

        return $this;
    }

    public function getPrimaryHero(): Hero
    {
        return $this->primaryHero;
    }
    
    public function getHeroMatchUps(): array
    {
        return $this->heroMatchUps;
    }

    public function hasHeroMatchUp(HeroMatchUp $heroMatchUp)
    {
        return in_array($heroMatchUp, $this->heroMatchUps);
    }
}
