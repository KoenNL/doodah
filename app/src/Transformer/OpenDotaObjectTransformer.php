<?php

namespace App\Transformer;

use stdClass;

abstract class OpenDotaObjectTransformer {
    
    abstract public function transform(stdClass $jsonObject);
    
    public function transformAll(array $objects): array
    {
        $transformedObjects = [];
        
        foreach ($objects as $object) {
            $transformedObjects[] = $this->transform($object);
        }
        
        return $transformedObjects;
    }
}
