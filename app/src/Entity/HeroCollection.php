<?php
namespace App\Entity;

class HeroCollection
{

    private $heroes = [];

    public function __construct(array $heroes = [])
    {
        $this->heroes = $heroes;
    }

    public function addHero(HeroHero $hero)
    {
        if (!$this->hasHero($hero)) {
            $this->heroes[] = $hero;
        }

        return $this;
    }

    public function getHeroes(): array
    {
        return $this->heroes;
    }

    public function getHeroById(int $heroId): Hero
    {
        foreach ($this->heroes as $hero) {
            if ($hero->getId() === $heroId) {
                return $hero;
            }
        }
        
        return null;
    }

    public function hasHero(HeroHero $hero)
    {
        return in_array($hero, $this->heroes);
    }
}
