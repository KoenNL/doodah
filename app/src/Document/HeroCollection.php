<?php
namespace App\Document;

use App\Exception\TooManyHeroesException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class HeroCollection extends ArrayCollection
{

    const MAX_HEROES = 0;

    /**
     * @MongoDB\Id
     * @var int
     */
    private $id;

    /**
     * @ReferenceMany(targetDocument="Hero", cascade="all")
     * @var Collection
     */
    private $heroes;

    /**
     * @param Collection $heroes
     * @throws TooManyHeroesException
     */
    public function __construct(Collection $heroes)
    {
        parent::__construct();

        foreach ($heroes as $hero) {
            $this->addHero($hero);
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Hero $hero
     * @return HeroCollection
     * @throws TooManyHeroesException
     */
    public function addHero(Hero $hero): self
    {
        if (self::MAX_HEROES > 0 && $this->heroes->count() === self::MAX_HEROES) {
            throw new TooManyHeroesException(self::MAX_HEROES);
        }
        
        if (!$this->hasHero($hero)) {
            $this->heroes->add($hero);
        }

        return $this;
    }

    public function getHeroes(): Collection
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

    public function hasHero(Hero $hero): bool
    {
        return $this->heroes->contains($hero);
    }
    
    protected function removeHero(Hero $heroToBeRemoved)
    {
        $this->heroes->removeElement($heroToBeRemoved);
    }
}
