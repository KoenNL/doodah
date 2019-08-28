<?php
namespace App\Normalizer;

use App\Document\Match;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MatchNormalizer implements NormalizerInterface
{
    
    private $playerNormalizer;
    private $heroCollectionNormalizer;
    private $dateTimeNormalizer;
    
    /**
     * @param PlayerNormalizer $playerNormalizer
     * @param HeroCollectionNormalizer $heroCollectionNormalizer
     */
    public function __construct(PlayerNormalizer $playerNormalizer, HeroCollectionNormalizer $heroCollectionNormalizer)
    {
        $this->playerNormalizer = $playerNormalizer;
        $this->heroCollectionNormalizer = $heroCollectionNormalizer;
    }
    
    /**
     * @param Match $object
     * @param type $format
     * @param array $context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'bannedHeroes' => $this->heroCollectionNormalizer->normalize($object->getBannedHeroes()),
            'opposingTeamHeroes' => $this->heroCollectionNormalizer->normalize($object->getOpposingTeamHeroes()),
            'player' => $this->playerNormalizer->normalize($object->getPlayer()),
            'playerPosition' => $object->getPlayerPosition(),
            'playerTeamHeroes' => $this->heroCollectionNormalizer->normalize($object->getPlayerTeamHeroes()),
            'startTime' => $object->getStartTime()
        ];
    }

    /**
     * @param Match $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Match && $format === 'json';
    }
}
