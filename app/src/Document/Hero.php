<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Hero
{

    /**
     * @MongoDB\Id(strategy="NONE")
     * @var int
     */
    private $id;
    /**
     * @MongoDB\Field(type="string")
     * @var string
     */
    private $name;
    /**
     * @MongoDB\Field(type="string")
     * @var string
     */
    private $localizedName;
    /**
     * @ReferenceOne(targetDocument="HeroAttribute", cascade={"persist"})
     * @var HeroAttribute
     */
    private $primaryAttribute;
    /**
     * @MongoDB\Field(type="string")
     * @var string
     */
    private $attackType;
    /**
     * @ReferenceOne(targetDocument="HeroRoleCollection", cascade={"persist"})
     * @var HeroRoleCollection
     */
    private $roles = [];
    /**
     * @MongoDB\Field(type="integer")
     * @var int
     */
    private $legs;

    /**
     * @param int $id
     * @param string $name
     * @param string $localizedName
     * @param HeroAttribute $primaryAttribute
     * @param string $attackType
     * @param HeroRoleCollection $roles
     * @param int $legs
     */
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

    public function getLegs(): int
    {
        return $this->legs;
    }
}
