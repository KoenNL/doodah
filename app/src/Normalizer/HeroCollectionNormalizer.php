<?php
namespace App\Normalizer;

use App\Document\HeroCollection;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HeroCollectionNormalizer implements NormalizerInterface
{
    
    private $heroNormalizer;
    
    /**
     * @param HeroNormalizer $heroNormalizer
     */
    public function __construct(HeroNormalizer $heroNormalizer)
    {
        $this->heroNormalizer = $heroNormalizer;
    }


    /**
     * @param HeroCollection $object
     * @param string $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $heroes = [];
        
        foreach ($object->getHeroes() as $hero) {
            $heroes[] = $this->heroNormalizer->normalize($hero);
        }
        
        return [
            'heroes' => $heroes
        ];
    }

    /**
     * @param HeroCollection $data
     * @param string $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof HeroCollection && $format === 'json';
    }
}
