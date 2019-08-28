<?php
namespace App\Transformer;

use App\Document\HeroCollection;
use App\Document\Player;
use App\Document\PlayerHero;
use DateTime;
use stdClass;

class PlayerHeroTransformer extends OpenDotaObjectTransformer
{
    
    private $player;
    
    private $allHeroes;
    
    function __construct(Player $player, HeroCollection $allHeroes)
    {
        $this->player = $player;
        $this->allHeroes = $allHeroes;
    }

    
    public function transform(stdClass $jsonObject)
    {
        $hero = $this->allHeroes->getHeroById((int) $jsonObject->hero_id);
        
        return new PlayerHero(
            $hero->getId(), 
            $hero->getName(), 
            $hero->getLocalizedName(), 
            $hero->getPrimaryAttribute(), 
            $hero->getAttackType(), 
            $hero->getRoles(), 
            $hero->getRoles(), 
            $this->player, 
            new DateTime($jsonObject->last_played), 
            $jsonObject->games, 
            $jsonObject->wins, 
            $jsonObject->with_games, 
            $jsonObject->with_win, 
            $jsonObject->against_games, 
            $jsonObject->against_win
        );
    }
}
