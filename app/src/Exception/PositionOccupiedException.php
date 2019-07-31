<?php
namespace App\Exception;

class PositionOccupiedException extends \Exception
{
    
    public function __construct(int $position)
    {
        parent::__construct('Position ' . $position . ' is already occupied.');
    }
}
