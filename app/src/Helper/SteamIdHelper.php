<?php
namespace App\Helper;

class SteamIdHelper
{

    const HOSTNAME = 'https://steamcommunity.com';
    const URI = 'profiles';
    const URL_LENGTH = 53;

    public static function validateUrl(string $url): bool
    {
        $strippedUrl = self::stripLastSlash($url);
        return (!empty($strippedUrl) && strpos($strippedUrl, self::HOSTNAME) !== false && strpos($strippedUrl, self::URI) !== false && strlen($strippedUrl) === self::URL_LENGTH);
    }

    public static function stripLastSlash(string $url): string
    {
        return rtrim($url, '/');
    }
    
    public static function stripIdFromUrl(string $url): int
    {
        if (!self::validateUrl($url)){
            return 0;
        }
        $strippedUrl = self::stripLastSlash($url);
        return (int) trim(substr($strippedUrl, strripos($strippedUrl, '/')), '/');
    }

    public static function to32Bit(int $id64Bit): int
    {
        if ($id64Bit <= 0) {
            return 0;
        }
        
        return (int) substr($id64Bit, 3) - 61197960265728;
    }
}
