<?php
namespace App\Transformer;

use App\Entity\HeroCollection;
use App\Entity\HeroMatchUp;
use stdClass;

class HeroMatchupTransformer extends OpenDotaObjectTransformer
{

    private $heroCollection;
    private $primaryHeroId;

    public function __construct(HeroCollection $heroCollection, int $primaryHeroId)
    {
        $this->heroCollection = $heroCollection;
        $this->primaryHeroId = $primaryHeroId;
    }

    public function transform(stdClass $jsonObject)
    {
        return new HeroMatchUp(
            $this->heroCollection->getHeroById($this->primaryHeroId), 
            $this->heroCollection->getHeroById((int) $jsonObject->hero_id), 
            (int) $jsonObject->games_played, 
            (int) $jsonObject->wins
        );
    }
}
