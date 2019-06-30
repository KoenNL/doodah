<?php
namespace App\Entity;

use App\Entity\Hero;

class PerdictedHero extends Hero
{
    
    private $position;
    
    function __construct(int $id, string $name, string $localizedName, HeroAttribute $primaryAttribute, string $attackType, HeroRoleCollection $roles, int $legs, int $position)
    {
        parent::__construct($id, $name, $localizedName, $primaryAttribute, $attackType, $roles, $legs);
        
        $this->position = $position;
    }
    
    function getPosition(): int
    {
        return $this->position;
    }

    function setPosition($position): self
    {
        $this->position = $position;
        return $this;
    }

}
