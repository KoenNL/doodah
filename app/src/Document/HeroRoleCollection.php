<?php

namespace App\Document;

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
     * @var array
     */
    private $roles = [];
    
    public function __construct(array $roles = []) {
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
            $this->roles[] = $role;
        }
        
        return $this;
    }
    
    public function getRoles(): array {
        return $this->roles;
    }
    
    public function hasRole(HeroRole $role) {
        return in_array($role, $this->roles);
    }
}
