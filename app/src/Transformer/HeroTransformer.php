<?php
namespace App\Transformer;

use App\Document\Hero;
use App\Document\HeroAttribute;
use App\Document\HeroRole;
use App\Document\HeroRoleCollection;
use App\Helper\HeroAttributeHerlper;
use stdClass;

class HeroTransformer extends OpenDotaObjectTransformer
{

    public function transform(stdClass $jsonObject): Hero
    {
        $heroRoleCollection = new HeroRoleCollection();

        foreach ($jsonObject->roles as $roleName) {
            $heroRoleCollection->addRole(new HeroRole($roleName));
        }

        return new Hero(
            $jsonObject->id, 
            $jsonObject->name, 
            $jsonObject->localized_name,
            new HeroAttribute(HeroAttributeHerlper::getAttributeNameFromKey($jsonObject->primary_attr), $jsonObject->primary_attr), 
            $jsonObject->attack_type, 
            $heroRoleCollection, 
            $jsonObject->legs
        );
    }
}
