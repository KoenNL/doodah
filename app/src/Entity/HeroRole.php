<?php

namespace App\Entity;

/**
 * @MongoDB\Document
 */
class HeroRole {
    
    /**
     * @MongoDB\Field(type="string")
     * @var string
     */
    private $name;
    
    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
