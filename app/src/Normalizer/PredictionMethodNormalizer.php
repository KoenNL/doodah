<?php
namespace App\Normalizer;

use App\PredictionMethod\PredictionMethod;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PredictionMethodNormalizer implements NormalizerInterface
{
    
    /**
     * @param PredictionMethod $object
     * @param type $format
     * @param array $context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return [
            'name' => $object->getMethodName()
        ];
    }

    /**
     * @param PredictionMethod $data
     * @param type $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof PredictionMethod && $format === 'json';
    }
}
