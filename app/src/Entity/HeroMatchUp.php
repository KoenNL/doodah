<?php
namespace App\Entity;

class HeroMatchUp
{

    private $primaryHero;
    private $contestingHero;
    private $gamesPlayed;
    private $wins;

    public function __construct(Hero $primaryHero, Hero $contestingHero, int $gamesPlayed, int $wins)
    {
        $this->primaryHero = $primaryHero;
        $this->contestingHero = $contestingHero;
        $this->gamesPlayed = $gamesPlayed;
        $this->wins = $wins;
    }

    public function getPrimaryHero(): Hero
    {
        return $this->primaryHero;
    }

    public function getContestingHero(): Hero
    {
        return $this->contestingHero;
    }

    public function getGamesPlayed(): int
    {
        return $this->gamesPlayed;
    }

    public function getWins(): int
    {
        return $this->wins;
    }
}
