<?php

namespace App\Entity;

use App\Entity\HeroRole;

/**
 * @MongoDB\Document
 */
class HeroRoleCollection {
    
    /**
     * @ReferenceMany(targetDocument="HeroRole")
     * @var array
     */
    private $roles = [];
    
    public function __construct(array $roles = []) {
        $this->roles = $roles;
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
