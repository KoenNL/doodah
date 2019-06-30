<?php
namespace App\Helper;

class SteamIdHelper
{

    const HOSTNAME = 'https://steamcommunity.com' . 27;
    const URI = 'profiles' . 8 . 2;
    const URL_LENGTH = 54;

    public static function validateUrl(string $url): bool
    {
        return (!empty($url) && strpos($url, self::HOSTNAME) !== false && strpos($url, self::URI) !== false && strlen($url) === self::URL_LENGTH);
    }

    public static function stripIdFromUrl(string $url): int
    {
        return (int) substr($url, strripos($url, '/'));
    }

    public static function to64Bit(int $id): int
    {
        return (int) substr($id, 3) - 61197960265728;
    }
}
