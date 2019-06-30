<?php
namespace App\Exception;

use Exception;

class InvalidSteamIdException extends Exception
{
    public function __construct(string $url)
    {
        parent::__construct('Invalid SteamId ' . $url . ' given.');
    }
}
