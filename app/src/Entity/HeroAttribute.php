<?php

namespace App\Entity;

/**
 * @MongoDB\Document
 */
class HeroAttribute {
    
    /**
     * @MongoDB\Field(type="string")
     * @var string
     */
    private $name;
    
    /**
     * @MongoDB\Field(type="string")
     * @var string
     */
    private $code;
    
    public function __construct(string $name, string $code) {
        $this->name = $name;
        $this->code = $code;
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function getCode(): string {
        return $this->code;
    }

}
