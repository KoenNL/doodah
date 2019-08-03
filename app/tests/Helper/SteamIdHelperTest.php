<?php
namespace tests\Helper;

use App\Helper\SteamIdHelper;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class SteamIdHelperTest extends TestCase
{

    private $validUrl = 'https://steamcommunity.com/profiles/76561198838445931/';
    private $invalidUrl = 'http://this.is-an-invalid-url.com/im/fake';
    private $invalidUrl2 = 'https://steamconnumity.com/profiles/76561198838445931/';

    public function testVerification()
    {
        $this->assertTrue(SteamIdHelper::validateUrl($this->validUrl));
        $this->assertFalse(SteamIdHelper::validateUrl($this->invalidUrl));
        $this->assertFalse(SteamIdHelper::validateUrl($this->invalidUrl2));
    }

    public function testConvertTo64Bit()
    {
        $validId = 76561198838445931;

        $this->assertEquals($validId, SteamIdHelper::stripIdFromUrl($this->validUrl));
        $this->assertEquals(null, SteamIdHelper::stripIdFromUrl($this->invalidUrl));
        $this->assertEquals(null, SteamIdHelper::stripIdFromUrl($this->invalidUrl2));
    }

    public function testConvertTo32Bit()
    {
        $validId = 878180203;
        
        $this->assertEquals($validId, SteamIdHelper::to32Bit(SteamIdHelper::stripIdFromUrl($this->validUrl)));
        $this->assertEquals(null, SteamIdHelper::to32Bit(SteamIdHelper::stripIdFromUrl($this->invalidUrl)));
        $this->assertEquals(null, SteamIdHelper::to32Bit(SteamIdHelper::stripIdFromUrl($this->invalidUrl2)));
    }
}
