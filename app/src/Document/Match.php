<?php
namespace App\Document;

use App\Document\HeroCollection;
use App\Exception\InvalidPlayerPositionException;
use DateTime;

class Match
{

    private $player;
    private $playerPosition;
    private $bannedHeroes;
    private $playerTeamHeroes;
    private $opposingTeamHeroes;
    private $startTime;

    /**
     * 
     * @param Player $player
     * @param int $playerPosition
     * @param BannedHeroCollection $bannedHeroes
     * @param TeamHeroCollection $playerTeamHeroes
     * @param TeamHeroCollection $opposingTeamHeroes
     * @param DateTime $startTime
     */
    function __construct(
        Player $player,
        int $playerPosition, 
        BannedHeroCollection $bannedHeroes, 
        TeamHeroCollection $playerTeamHeroes, 
        TeamHeroCollection $opposingTeamHeroes, 
        DateTime $startTime
        )
    {
        $this->player = $player;
        $this->playerPosition = $playerPosition;
        $this->bannedHeroes = $bannedHeroes;
        $this->playerTeamHeroes = $playerTeamHeroes;
        $this->opposingTeamHeroes = $opposingTeamHeroes;
        $this->startTime = $startTime;
    }

    function getPlayer(): Player
    {
        return $this->player;
    }
    
    function getPlayerPosition(): int
    {
        return $this->playerPosition;
    }

    function getBannedHeroes(): BannedHeroCollection
    {
        return $this->bannedHeroes;
    }

    function getPlayerTeamHeroes(): TeamHeroCollection
    {
        return $this->playerTeamHeroes;
    }

    function getOpposingTeamHeroes(): TeamHeroCollection
    {
        return $this->opposingTeamHeroes;
    }

    function getStartTime()
    {
        return $this->startTime;
    }

    public function setPlayerPosition(int $playerPosition): self
    {
        if ($playerPosition > 5 || $playerPosition < 1) {
            throw new InvalidPlayerPositionException($playerPosition);
        }

        $this->playerPosition = $playerPosition;

        return $this;
    }
}
