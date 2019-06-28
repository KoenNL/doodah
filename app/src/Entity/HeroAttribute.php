<?php

namespace App\Entity;

class HeroAttribute {
    private $name;
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
