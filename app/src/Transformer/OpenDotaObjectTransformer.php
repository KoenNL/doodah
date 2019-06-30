<?php

namespace App\Transformer;

use stdClass;

interface OpenDotaObjectTransformer {
    public function transform(stdClass $jsonObject);
}
