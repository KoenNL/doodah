<?php
namespace App\Service;

use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\Player;
use App\Entity\PlayerHeroCollection;
use App\Service\OpenDotaApiService;
use App\Transformer\HeroCollectionTransformer;
use App\Transformer\PlayerHeroTransformer;

class PlayerService extends OpenDotaApiService
{
    
    private $allHeroes;
    
    function __construct(HeroCollection $allHeroes)
    {
        $this->allHeroes = $allHeroes;
    }

    public function getHeroes(Player $player, array $parameters): PlayerHeroCollection
    {
        $playerHeroTransformer = new PlayerHeroTransformer($player, $this->allHeroes);
        
        return $playerHeroTransformer->transform($this->doRequest(parent::URI_GET_PLAYER_HEROES, $player->getId(), $parameters));
    }
    
    public function getFavoriteHeroes(Match $match): PlayerHeroCollection
    {
        $parameters = [
            'win' => 1,
            'with_hero_id' => HeroCollectionTransformer::toIds($match->getPlayerTeamHeroes()),
            'against_hero_id' => HeroCollectionTransformer::toIds($match->getOpposingTeamHeroes())
        ];
        
        return $this->getHeroes($match->getPlayer(), $parameters);
    }
}
