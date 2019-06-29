<?php
namespace App\Entity;

use App\Entity\HeroCollection;
use App\Exception\InvalidPlayerPositionException;
use DateTime;

class Match
{

    private $player;
    private $playerPosition;
    private $bannedHeroes;
    private $playerTeamHeroes;
    private $opposingTeamHeroes;
    private $playerFamiliarHeroes;
    private $startTime;

    /**
     * 
     * @param Player $player
     * @param int $playerPosition
     * @param BannedHeroCollection $bannedHeroes
     * @param TeamHeroCollection $playerTeamHeroes
     * @param TeamHeroCollection $opposingTeamHeroes
     * @param HeroCollection $playerFamiliarHeroes
     * @param DateTime $startTime
     */
    function __construct(
        Player $player,
        int $playerPosition, 
        BannedHeroCollection $bannedHeroes, 
        TeamHeroCollection $playerTeamHeroes, 
        TeamHeroCollection $opposingTeamHeroes, 
        HeroCollection $playerFamiliarHeroes,
        DateTime $startTime
        )
    {
        $this->player = $player;
        $this->playerPosition = $playerPosition;
        $this->bannedHeroes = $bannedHeroes;
        $this->playerTeamHeroes = $playerTeamHeroes;
        $this->opposingTeamHeroes = $opposingTeamHeroes;
        $this->playerFamiliarHeroes = $playerFamiliarHeroes;
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

    function getPlayerFamiliarHeroes(): HeroCollection
    {
        return $this->playerFamiliarHeroes;
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
