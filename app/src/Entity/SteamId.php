<?php
namespace App\Entity;

use App\Exception\InvalidSteamIdException;
use App\Helper\SteamIdHelper;

class SteamId
{

    private $url;
    private $id64;
    private $id32;

    function __construct(string $url)
    {
        if (!SteamIdHelper::validateUrl($url)) {
            throw new InvalidSteamIdException($url);
        }
        
        $this->url = $url;
    }

    function getUrl(): string
    {
        return $this->url;
    }

    function getId64(): int
    {
        if (empty($this->id64)) {
            $this->id64 = SteamIdHelper::stripIdFromUrl($this->url);
        }
        
        return $this->id64;
    }

    function getId32(): int
    {
        if (empty($this->id32)) {
            $this->id32 = SteamIdHelper::to64Bit($this->getId64());
        }
        
        return $this->id32;
    }
}
