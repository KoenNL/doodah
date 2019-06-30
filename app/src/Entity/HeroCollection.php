<?php
namespace App\Entity;

use App\Entity\FileWritable;
use App\Exception\TooManyHeroesException;

class HeroCollection implements FileWritable
{

    const MAX_HEROES = 0;
    
    private $heroes = [];

    public function __construct(array $heroes = [])
    {
        foreach ($heroes as $hero) {
            $this->addHero($hero);
        }
    }

    public function addHero(Hero $hero)
    {
        if (self::MAX_HEROES > 0 && count($this->heroes) === self::MAX_HEROES) {
            throw new TooManyHeroesException(self::MAX_HEROES);
        }
        
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
    
    protected function removeHero(Hero $heroToBeRemoved)
    {
        foreach ($this->getHeroes() as $position => $hero) {
            if ($hero->getId() === $heroToBeRemoved->getId()) {
                unset($this->heroes[$position]);
            }
        }
    }
}
