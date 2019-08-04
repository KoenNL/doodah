<?php
namespace App\Controller;

use App\Normalizer\HeroCollectionNormalizer;
use App\Normalizer\HeroNormalizer;
use App\Normalizer\HeroRoleNormalizer;
use App\Service\HeroCollectionService;
use App\Service\HeroService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class HeroController extends AbstractController
{

    /**
     * @Route("api/hero/list", name="getHeroes")
     */
    public function getHeroes(HeroCollectionService $heroCollectionService, HeroService $heroService)
    {
        $heroCollection = $heroCollectionService->load();

        if (empty($heroCollection)) {
            $heroCollectionService->refreshHeroCollection($heroService);
        }

        $serializer = new \Symfony\Component\Serializer(
            [
            new HeroCollectionNormalizer(
                new HeroNormalizer(
                new HeroRoleNormalizer()
                )
            )
            ], [new JsonEncoder()]
        );

        return new JsonResponse($serializer->serialze($heroCollection), Response::HTTP_OK, [], true);
    }
}
