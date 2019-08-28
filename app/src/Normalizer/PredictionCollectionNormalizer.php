<?php
namespace App\Normalizer;

use App\Document\PredictionCollection;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class PredictionCollectionNormalizer implements NormalizerInterface
{
    
    private $predictionNormalizer;
    private $matchNormalizer;
    private $predictionMethodNormalizer;
    
    /**
     * @param PredictionNormalizer $predictionNormalizer
     * @param MatchNormalizer $matchNormalizer
     * @param PredictionMethodNormalizer $predictionMethodNormalizer
     */
    public function __construct(PredictionNormalizer $predictionNormalizer, MatchNormalizer $matchNormalizer, PredictionMethodNormalizer $predictionMethodNormalizer)
    {
        $this->predictionNormalizer = $predictionNormalizer;
        $this->matchNormalizer = $matchNormalizer;
        $this->predictionMethodNormalizer = $predictionMethodNormalizer;
    }
    
    /**
     * @param PredictionCollection $object
     * @param type $format
     * @param array $context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $predictions = [];
        
        foreach ($object->getPredictions() as $prediction) {
            $predictions[] = $this->predictionNormalizer->normalize($prediction);
        }
        
        return [
            'match' => $this->matchNormalizer->normalize($object->getMatch()),
            'predictionMethod' => $this->predictionMethodNormalizer->normalize($object->getPredictionMethod()),
            'predictions' => $predictions
        ];
    }

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof PredictionNormalizer && $format === 'json';
    }
}
