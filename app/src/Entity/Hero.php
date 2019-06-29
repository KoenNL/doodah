<?php
namespace App\Entity;

use App\Entity\HeroAttribute;
use App\Entity\HeroRoleCollection;

class Hero
{

    private $id;
    private $name;
    private $localizedName;
    private $primaryAttribute;
    private $attackType;
    private $roles = [];
    private $legs;

    public function __construct(int $id, string $name, string $localizedName, HeroAttribute $primaryAttribute, string $attackType, HeroRoleCollection $roles, int $legs)
    {
        $this->id = $id;
        $this->name = $name;
        $this->localizedName = $localizedName;
        $this->primaryAttribute = $primaryAttribute;
        $this->attackType = $attackType;
        $this->roles = $roles;
        $this->legs = $legs;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalizedName(): string
    {
        return $this->localizedName;
    }

    public function getPrimaryAttribute(): HeroAttribute
    {
        return $this->primaryAttribute;
    }

    public function getAttackType(): string
    {
        return $this->attackType;
    }

    public function getRoles(): HeroRoleCollection
    {
        return $this->roles;
    }

    public function getLeggs(): int
    {
        return $this->legs;
    }
}
