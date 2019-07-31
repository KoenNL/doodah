<?php
namespace App\Normalizer;

use App\Entity\SteamId;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SteamIdNormalizer implements NormalizerInterface
{
    
    /**
     * @param SteamId $object
     * @param type $format
     * @param array $context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'id32' => $object->getId32(),
            'id64' => $object->getId64(),
            'url' => $object->getUrl()
        ];
    }

    /**
     * @param SteamId $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof SteamId && $format === 'json';
    }
}
