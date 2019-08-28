<?php
namespace App\Document;

use App\Document\Hero;
use App\Document\HeroAttribute;
use App\Document\HeroRoleCollection;
use DateTime;

class PlayerHero extends Hero
{
    
    private $player;
    private $lastPlayed;
    private $games;
    private $wins;
    private $withGames;
    private $withWin;
    private $againstGames;
    private $againstWin;
    
    /**
     * 
     * @param int $heroId
     * @param string $name
     * @param string $localizedName
     * @param HeroAttribute $primaryAttribute
     * @param string $attackType
     * @param HeroRoleCollection $roles
     * @param int $legs
     * @param Player $player
     * @param DateTime $lastPlayed
     * @param int $games
     * @param int $wins
     * @param int $withGames
     * @param int $withWin
     * @param int $againstGames
     * @param int $againstWin
     */
    function __construct(
        int $heroId, 
        string $name, 
        string $localizedName, 
        HeroAttribute $primaryAttribute, 
        string $attackType, 
        HeroRoleCollection $roles, 
        int $legs,
        Player $player,
        DateTime $lastPlayed, 
        int $games, 
        int $wins, 
        int $withGames, 
        int $withWin, 
        int $againstGames, 
        int $againstWin
        )
    {
        parent::__construct($heroId, $name, $localizedName, $primaryAttribute, $attackType, $roles, $legs);
        
        $this->player = $player;
        $this->lastPlayed = $lastPlayed;
        $this->games = $games;
        $this->wins = $wins;
        $this->withGames = $withGames;
        $this->withWin = $withWin;
        $this->againstGames = $againstGames;
        $this->againstWin = $againstWin;
    }
    
    function getPlayer(): Player
    {
        return $this->player;
    }

    function getLastPlayed(): DateTime
    {
        return $this->lastPlayed;
    }

    function getGames(): int
    {
        return $this->games;
    }

    function getWins(): int
    {
        return $this->wins;
    }

    function getWithGames(): int
    {
        return $this->withGames;
    }

    function getWithWin(): int
    {
        return $this->withWin;
    }

    function getAgainstGames(): int
    {
        return $this->againstGames;
    }

    function getAgainstWin(): int
    {
        return $this->againstWin;
    }
    
}
