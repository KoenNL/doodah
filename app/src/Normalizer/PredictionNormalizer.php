<?php
namespace App\Normalizer;

use App\Document\Prediction;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PredictionNormalizer implements NormalizerInterface
{
    
    private $heroNormalizer;
    
    /**
     * @param \App\Normalizer\HeroNormalizer $heroNormalizer
     */
    public function __construct(HeroNormalizer $heroNormalizer)
    {
        $this->heroNormalizer = $heroNormalizer;
    }
    
    /**
     * @param Prediction $object
     * @param type $format
     * @param array $context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'hero' => $object->getHero(),
            'position' => $object->getPosition()
        ];
    }

    /**
     * @param Prediction $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Prediction && $format === 'json';
    }
}
