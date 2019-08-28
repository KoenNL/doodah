<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class HeroAttribute {

    /**
     * @MongoDB\Id
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
    private $code;
    
    public function __construct(string $name, string $code) {
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string {
        return $this->name;
    }

    public function getCode(): string {
        return $this->code;
    }

}
