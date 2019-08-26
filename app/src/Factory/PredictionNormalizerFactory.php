<?php
namespace App\Factory;

use App\Normalizer\HeroCollectionNormalizer;
use App\Normalizer\HeroNormalizer;
use App\Normalizer\HeroRoleNormalizer;
use App\Normalizer\MatchNormalizer;
use App\Normalizer\PlayerNormalizer;
use App\Normalizer\PredictionCollectionNormalizer;
use App\Normalizer\PredictionMethodNormalizer;
use App\Normalizer\PredictionNormalizer;
use App\Normalizer\SteamIdNormalizer;

class PredictionNormalizerFactory
{

    public static function build()
    {
        return new PredictionCollectionNormalizer(
            new PredictionNormalizer(
                new HeroNormalizer(
                    new HeroRoleNormalizer()
                )
            ), 
            new MatchNormalizer(
                new PlayerNormalizer(
                    new SteamIdNormalizer()
                ),
                new HeroCollectionNormalizer(
                    new HeroNormalizer()
                )
            ),
            new PredictionMethodNormalizer()
        );
    }
}
