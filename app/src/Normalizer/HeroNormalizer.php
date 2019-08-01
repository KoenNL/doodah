<?php
namespace App\Normalizer;

use App\Entity\Hero;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HeroNormalizer implements NormalizerInterface
{
    
    private $heroRoleNormalizer;
    
    /**
     * @param \App\Normalizer\HeroRoleNormalizer $heroRoleNormalizer
     */
    public function __construct(HeroRoleNormalizer $heroRoleNormalizer)
    {
        $this->heroRoleNormalizer = $heroRoleNormalizer;
    }
    
    /**
     * @param Hero $object
     * @param type $format
     * @param array $context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $roles = [];
        
        foreach ($object->getRoles() as $heroRole) {
            $roles[] = $this->heroRoleNormalizer->normalize($heroRole);
        }
        
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'localizedName' => $object->getLocalizedName(),
            'legs' => $object->getLegs(),
            'attackType' => $object->getAttackType(),
            'primaryAttribute' => $object->getPrimaryAttribute(),
            'roles' => $roles
        ];
    }

    /**
     * @param Hero $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Hero && $format === 'json';
    }
}
