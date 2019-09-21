<?php


namespace App\Exception;


use Exception;

class InvalidHeroIdException extends Exception
{

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        parent::__construct(sprintf('Hero with id %d does not exist', $id));
    }
}