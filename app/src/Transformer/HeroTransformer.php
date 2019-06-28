<?php
namespace App\Transformer;

use App\Entity\Hero;
use App\Entity\HeroAttribute;
use App\Entity\HeroRoleCollection;
use stdClass;

class HeroTransformer implements OpenDotaObjectTransformer
{

    public function transform(stdClass $jsonObject): Hero
    {
        $heroRoleCollection = new HeroRoleCollection();

        foreach ($jsonObject->roles as $role) {
            $heroRoleCollection->addRole($role);
        }

        return new Hero(
            $jsonObject->id, 
            $jsonObject->name, 
            $jsonObject->localized_name,
            //@TODO Translate the code to the corresponding full name.
            new HeroAttribute($jsonObject->code, $jsonObject->code), 
            $jsonObject->attack_type, 
            $heroRoleCollection, 
            $jsonObject->legs
        );
    }
}
