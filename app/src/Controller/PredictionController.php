<?php
namespace App\Controller;

use App\Entity\BannedHeroCollection;
use App\Entity\HeroCollection;
use App\Entity\Match;
use App\Entity\Player;
use App\Entity\SteamId;
use App\Entity\TeamHeroCollection;
use App\Factory\PredictionNormalizerFactory;
use App\Helper\HeroCollectionHelper;
use App\PredictionMethod\OwnResultsPredictionMethod;
use App\Service\HeroCollectionService;
use App\Service\HeroService;
use App\Service\PlayerService;
use App\Service\PredictionService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class PredictionController extends AbstractController
{
    
    /**
     * 
     * @param Request $requets
     * @return JsonResponse
     * 
     * $Route("predict", name="predict")
     */
    public function predictAction(Request $requets)
    {
        $heroCollectionService = new HeroCollectionService(HeroCollection::class);
        $heroCollection = $heroCollectionService->load();
        
        if (count($heroCollection->getHeroes()) === 0) {
            $heroCollectionService->refreshHeroCollection(new HeroService());
        }
        
        $match = new Match(
            new Player(new SteamId($requets->get('steamId')), 'player'), 
            (int) $requets->get('playerPosition'), 
            new BannedHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $requets->get('bannedHeroesIds'))->getHeroes()), 
            new TeamHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $requets->get('teamHeroesIds'))->getHeroes()), 
            new TeamHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $requets->get('opposingHeroesIds'))->getHeroes()), 
            new DateTime()
        );
        
        
        $predictionService = new PredictionService(
            $match, 
            new OwnResultsPredictionMethod(
                $match, 
                new PlayerService($heroCollection)
            )
        );
        
        $predictionCollection = $predictionService->removeBannedHeroesFromPrediction($predictionService->predict($match));
        
        $serializer = new \Symfony\Component\Serializer([PredictionNormalizerFactory::build()], [new JsonEncoder()]);
        
        return new JsonResponse($serializer->serialize($predictionCollection));
    }
}
