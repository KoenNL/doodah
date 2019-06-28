<?php

namespace App\Transformer;

interface OpenDotaObjectTransformer {
    public function transform(stdClass $jsonObject);
}
