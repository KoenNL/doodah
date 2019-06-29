<?php
namespace App\Entity;

use App\Entity\HeroCollection;
use App\Exception\InvalidPlayerPositionException;
use DateTime;

class Match
{

    private $playerPosition;
    private $bannedHeroes;
    private $playerTeamHeroes;
    private $opposingTeamHeroes;
    private $playerFamiliarHeroes;
    private $startTime;

    /**
     * 
     * @param int $playerPosition
     * @param BannedHeroCollection $bannedHeroes
     * @param TeamHeroCollection $playerTeamHeroes
     * @param TeamHeroCollection $opposingTeamHeroes
     * @param HeroCollection $playerFamiliarHeroes
     * @param DateTime $startTime
     */
    function __construct(
        int $playerPosition, 
        BannedHeroCollection $bannedHeroes, 
        TeamHeroCollection $playerTeamHeroes, 
        TeamHeroCollection $opposingTeamHeroes, 
        HeroCollection $playerFamiliarHeroes,
        DateTime $startTime
        )
    {
        $this->playerPosition = $playerPosition;
        $this->bannedHeroes = $bannedHeroes;
        $this->playerTeamHeroes = $playerTeamHeroes;
        $this->opposingTeamHeroes = $opposingTeamHeroes;
        $this->playerFamiliarHeroes = $playerFamiliarHeroes;
        $this->startTime = $startTime;
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
