<?php
namespace App\Controller;

use App\Entity\BannedHeroCollection;
use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\Player;
use App\Entity\TeamHeroCollection;
use App\PerdictionMethod\OwnResultsPerdictionMethod;
use App\Service\HeroCollectionService;
use App\Service\HeroService;
use App\Service\PerdictionService;
use App\Service\PlayerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PerdictionController extends AbstractController
{
    
    /**
     * 
     * @param Request $requets
     * @return JsonResponse
     * 
     * $Route("perdict", name="perdict")
     */
    public function perdictAction(Request $requets)
    {
        $heroCollectionService = new HeroCollectionService(HeroCollection::class);
        $heroCollection = $heroCollectionService->load();
        
        if (count($heroCollection->getHeroes()) === 0) {
            $heroCollectionService->refreshHeroCollection(new HeroService());
        }
        
        $match = new Match(
            new Player($requets->get('playerId'), 'player'), 
            (int) $requets->get('playerPosition'), 
            new BannedHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $requets->get('bannedHeroesIds'))->getHeroes()), 
            new TeamHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $requets->get('teamHeroesIds'))->getHeroes()), 
            new TeamHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $requets->get('opposingHeroesIds'))->getHeroes()), 
            new DateTime()
        );
        
        
        $perdictionService = new PerdictionService(
            $match, 
            new OwnResultsPerdictionMethod(
                $match, 
                new PlayerService($heroCollection)
            )
        );
        
        $perdictedHeroCollection = $perdictionService->perdict();
        
        return new JsonResponse($perdictedHeroCollection);
    }
}