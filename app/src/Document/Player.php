<?php
namespace App\Document;

class Player
{
    
    private $steamId;
    private $name;
    
    function __construct(SteamId $steamId, string $name)
    {
        $this->steamId = $steamId;
        $this->name = $name;
    }
    
    function getSteamId(): SteamId
    {
        return $this->steamId;
    }

    function getName(): string
    {
        return $this->name;
    }
}
