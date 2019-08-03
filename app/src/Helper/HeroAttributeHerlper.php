<?php
namespace App\Helper;

class HeroAttributeHerlper
{
    
    const KEY_AGI = 'agi';
    const KEY_INT = 'int';
    const KEY_STR = 'str';
    
    const ATTRIBUTES = [
        self::KEY_AGI => 'Agility',
        self::KEY_INT => 'Intelligence',
        self::KEY_STR => 'Strength'
    ];
    
    /**
     * @param string $key
     * @return string
     */
    public static function getAttributeNameFromKey(string $key): string
    {
        return self::ATTRIBUTES[$key];
    }
}
