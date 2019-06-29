<?php
namespace App\Exception;

class TooManyHeroesException extends \Exception
{
    function __construct(int $maxHeroes)
    {
        parent::__construct('You are trying to add too many heroes to this HeroCollection. This collection may only hold ' . $maxHeroes . ' heroes.');
    }

}
