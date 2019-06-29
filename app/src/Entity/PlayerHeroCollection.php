<?php
namespace App\Entity;

class PlayerHeroCollection extends HeroCollection
{
    
    public function addHero(PlayerHero $playerHero)
    {
        parent::addHero($playerHero);
    }
}
