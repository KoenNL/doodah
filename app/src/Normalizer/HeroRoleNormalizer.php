<?php
namespace App\Normalizer;

use App\Entity\HeroRole;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HeroRoleNormalizer implements NormalizerInterface
{
    
    /**
     * @param HeroRole $object
     * @param string|null $format
     * @param array $context
     */
    public function normalize($object, string $format = null, array $context = array())
    {
        return [
            'name' => $object->getName()
        ];
    }

    /**
     * @param HeroRole $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof HeroRole && $format === 'json';
    }
}
