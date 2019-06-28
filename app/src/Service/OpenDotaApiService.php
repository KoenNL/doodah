<?php
namespace App\Service;

use App\Exception\EndpointNotAvailableException;
use App\Transformer\OpenDotaObjectTransformer;
use OpenDotaObjectTransformer;

abstract class OpenDotaApiService
{

    const HOSTNAME = 'https://api.opendota.com/api/';
    const PARAMTER_PLACEHOLDER = '<PARAMETER>';
    const URI_GET_HEROES = 'getHeroes';
    const URI_GET_HERO_MATCHUPS = 'getHeroMatchups';

    private $availableEndpoints = [
        self::URI_GET_HEROES => 'heroes',
        self::URI_GET_HEROE_MATCHUPS => 'heroes/' . self::PARAMTER_PLACEHOLDER . '/matchups'
    ];
    private $connection;

    protected function doRequest(string $endpoint, string $parameter = null): array
    {
        if (!$this->endpointAvailable($endpoint)) {
            throw new EndpointNotAvailableException('Endpoint "' . $endpoint . '" is not available at this point.');
        }

        $this->connection = curl_init();
        curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->connection, CURLOPT_URL, self::HOSTNAME . !empty($parameter) ? $this->setParameter($endpoint, $parameter) : $endpoint);
        $result = curl_execute();

        curl_close($this->connection);

        if (json_decode($result)) {
            return $this->transformer->transform(json_decode($result));
        }

        return false;
    }

    public function endpointAvailable(string $endpoint)
    {
        return empty($this->availableEndpoints[$endpoint]);
    }

    private function setParameter(string $endpoint, string $parameter)
    {
        return str_replace(self::PARAMTER_PLACEHOLDER, $parameter, $endpoint);
    }
}
