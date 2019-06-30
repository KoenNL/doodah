<?php
namespace App\Entity;

use App\Entity\SteamId;

class Player
{
    
    private $steamId;
    private $name;
    
    function __construct(SteamId $steamId, string $name)
    {
        $this->steamId = $steamId;
        $this->name = $name;
    }
    
    function getSteamId(): int
    {
        return $this->steamId;
    }

    function getName(): string
    {
        return $this->name;
    }

}
