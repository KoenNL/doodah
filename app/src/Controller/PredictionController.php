<?php
namespace App\Controller;

use App\Document\BannedHeroCollection;
use App\Document\Match;
use App\Document\Player;
use App\Document\SteamId;
use App\Document\TeamHeroCollection;
use App\Exception\InvalidSteamIdException;
use App\Exception\TooManyHeroesException;
use App\Factory\PredictionNormalizerFactory;
use App\Helper\HeroCollectionHelper;
use App\PredictionMethod\OwnResultsPredictionMethod;
use App\Service\HeroService;
use App\Service\PlayerService;
use App\Service\PredictionService;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class PredictionController extends AbstractController
{

    /**
     * @Route("api/prediction", name="predict", methods="PUT")
     *
     * @param Request $request
     * @param HeroService $heroService
     * @return JsonResponse
     *
     * @throws InvalidSteamIdException
     */
    public function predictAction(Request $request, HeroService $heroService)
    {
        try {
            $heroCollection = $heroService->getHeroes();
        } catch (Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        try {
            $match = new Match(
                new Player(new SteamId($request->get('steamId')), 'player'),
                (int) $request->get('playerPosition'),
                new BannedHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $request->get('bannedHeroesIds'))->getHeroes()),
                new TeamHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $request->get('teamHeroesIds'))->getHeroes()),
                new TeamHeroCollection(HeroCollectionHelper::getHeroesByIds($heroCollection, $request->get('opposingHeroesIds'))->getHeroes()),
                new DateTime()
            );
        } catch (TooManyHeroesException $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $predictionService = new PredictionService(
            $match,
            new OwnResultsPredictionMethod(new PlayerService($heroCollection))
        );

        $predictionCollection = $predictionService->removeBannedHeroesFromPrediction($predictionService->predict());
        
        $serializer = new Serializer([PredictionNormalizerFactory::build()], [new JsonEncoder()]);
        
        return new JsonResponse($serializer->serialize($predictionCollection, 'json'), Response::HTTP_OK, [], true);
    }
}
