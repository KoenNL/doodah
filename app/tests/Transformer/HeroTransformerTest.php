<?php
namespace tests\Transformer;

use App\Entity\Hero;
use App\Entity\HeroAttribute;
use App\Entity\HeroRole;
use App\Entity\HeroRoleCollection;
use App\Transformer\HeroTransformer;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class HeroTransformerTest extends TestCase
{
    
   public function testTransform()
   {
       $data = '{"id":1,"name":"npc_dota_hero_antimage","localized_name":"Anti-Mage","primary_attr":"agi","attack_type":"Melee","roles":["Carry","Escape","Nuker"],"legs":2}';
       $validHero = new Hero(
           1, 
           'npc_dota_hero_antimage', 
           'Anti-Mage', 
           new HeroAttribute('Agility', 'agi'), 
           'Melee',
           new HeroRoleCollection([
               new HeroRole('Carry'), 
               new HeroRole('Escape'), 
               new HeroRole('Nuker')
           ]),
       2);
       
       $transformer = new HeroTransformer();
       
       $this->assertEquals($validHero, $transformer->transform(json_decode($data)));
   }
}
