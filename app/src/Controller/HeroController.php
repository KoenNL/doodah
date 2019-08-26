<?php
namespace App\Controller;

use App\Normalizer\HeroCollectionNormalizer;
use App\Normalizer\HeroNormalizer;
use App\Normalizer\HeroRoleNormalizer;
use App\Service\HeroService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class HeroController extends AbstractController
{

    /**
     * @Route("api/heroes", name="getHeroes")
     * @param HeroService $heroService
     * @return JsonResponse
     */
    public function getHeroes(HeroService $heroService)
    {
        try {
            $heroCollection = $heroService->getHeroes();
        } catch (Exception $exception) {
            return new JsonResponse(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $serializer = new Serializer(
            [
            new HeroCollectionNormalizer(
                new HeroNormalizer(
                new HeroRoleNormalizer()
                )
            )
            ], [new JsonEncoder()]
        );
        
        return new JsonResponse($serializer->serialize($heroCollection, 'json'), Response::HTTP_OK, [], true);
    }
}
