<?php
namespace App\Service;

use App\Document\HeroCollection;
use App\Document\HeroMatchUpCollection;
use App\Exception\EndpointNotAvailableException;
use App\Exception\TooManyHeroesException;
use App\Repository\HeroCollectionRepository;
use App\Transformer\HeroMatchupTransformer;
use App\Transformer\HeroTransformer;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class HeroService extends OpenDotaApiService
{

    private $heroCollection;
    private $documentManager;

    /**
     * @param DocumentManager $documentManager
     * @param HeroTransformer $transformer
     */
    public function __construct(DocumentManager $documentManager, HeroTransformer $transformer)
    {
        parent::__construct($transformer);
        $this->documentManager = $documentManager;
    }

    /**
     * @return HeroCollection
     * @throws EndpointNotAvailableException
     * @throws TooManyHeroesException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getHeroes(): HeroCollection
    {
        /** @var HeroCollectionRepository $repository */
        $repository = $this->documentManager->getRepository(HeroCollection::class);
        $this->heroCollection = $repository->findOneBy([]);

        if (empty($this->heroCollection)) {
            $this->heroCollection = new HeroCollection();
            foreach ($this->doRequest(parent::URI_GET_HEROES) as $hero) {
                $this->heroCollection->addHero($hero);
            }

            $this->documentManager->persist($this->heroCollection);
            $this->documentManager->flush();
        }

        return $this->heroCollection;
    }

    /**
     * @param int $heroId
     * @return HeroMatchUpCollection
     * @throws EndpointNotAvailableException
     * @throws TooManyHeroesException
     */
    public function getHeroMatchUps(int $heroId): HeroMatchUpCollection
    {
        $heroMatchUpCollection = new HeroMatchUpCollection($this->getHeroes()->getHeroById($heroId));
        $heroMatchUpTransformer = new HeroMatchupTransformer($this->getHeroes(), $heroId);

        foreach ($this->doRequest(parent::URI_GET_HERO_MATCHUPS, $heroId) as $heroMatchup) {
            $heroMatchUpCollection->addHeroMatchUp($heroMatchUpTransformer->transform($heroMatchup));
        }

        return $heroMatchUpCollection;
    }

    private function getSavedHeroCollection()
    {

    }
}
