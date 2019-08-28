<?php
namespace App\Document;

class PlayerHeroCollection extends HeroCollection
{
    
    public function addHero(Hero $playerHero): HeroCollection
    {
        return parent::addHero($playerHero);
    }
}
