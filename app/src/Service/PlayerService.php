<?php
namespace App\Service;

use App\Document\Match;
use App\Document\Player;
use App\Document\PlayerHeroCollection;
use App\Exception\EndpointNotAvailableException;
use App\Transformer\HeroCollectionTransformer;
use App\Transformer\PlayerHeroTransformer;

class PlayerService extends OpenDotaApiService
{

    function __construct(PlayerHeroTransformer $playerHeroTransformer)
    {
        parent::__construct($playerHeroTransformer);
    }

    /**
     * @param Player $player
     * @param array $parameters
     * @return PlayerHeroCollection
     * @throws EndpointNotAvailableException
     */
    public function getHeroes(Player $player, array $parameters): PlayerHeroCollection
    {
        $response = $this->doRequest(parent::URI_GET_PLAYER_HEROES, $player->getSteamId()->getId32(), $parameters);

        return $response->isSuccess() ? $response->getResult() : null;
    }

    /**
     * @param Match $match
     * @return PlayerHeroCollection
     * @throws EndpointNotAvailableException
     */
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
