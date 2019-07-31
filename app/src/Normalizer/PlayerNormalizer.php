<?php
namespace App\Normalizer;

use App\Entity\Player;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PlayerNormalizer implements NormalizerInterface
{
    
    private $steamIdNormalizer;
    
    /**
     * @param SteamIdNormalizer $steamIdNormalizer
     */
    public function __construct(SteamIdNormalizer $steamIdNormalizer)
    {
        $this->steamIdNormalizer = $steamIdNormalizer;
    }
    
    /**
     * 
     * @param Player $object
     * @param type $format
     * @param array $context
     * @return type
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'name' => $object->getName(),
            'steamId' => $this->steamIdNormalizer($object->getSteamId())
        ];
    }

    /**
     * @param Player $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Player && $format === 'json';
    }
}
