<?php

namespace App\Document;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @MongoDB\Document
 */
class HeroRoleCollection {

    /**
     * @MongoDB\Id
     * @var int
     */
    private $id;

    /**
     * @ReferenceMany(targetDocument="HeroRole", cascade={"persist"})
     * @var Collection
     */
    private $roles;
    
    public function __construct(array $roles) {
        $this->roles = $roles;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function addRole(HeroRole $role) {
        if (!$this->hasRole($role)) {
            $this->roles->add($role);
        }
        
        return $this;
    }
    
    public function getRoles(): Collection {
        return $this->roles;
    }
    
    public function hasRole(HeroRole $role) {
        return $this->roles->contains($role);
    }
}
