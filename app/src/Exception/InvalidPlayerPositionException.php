<?php

namespace App\Exception;

class InvalidPlayerPositionException extends \Exception
{
    function __construct(int $playerPosition)
    {
        parent::__construct('Position ' . $playerPosition . ' is not allowed.');
    }

}
