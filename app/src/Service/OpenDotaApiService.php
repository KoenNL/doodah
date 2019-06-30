<?php
namespace App\Service;

use App\Exception\EndpointNotAvailableException;

abstract class OpenDotaApiService
{

    const HOSTNAME = 'https://api.opendota.com/api/';
    const PARAMTER_PLACEHOLDER = '<PARAMETER>';
    
    const URI_GET_HEROES = 'getHeroes';
    const URI_GET_HERO_MATCHUPS = 'getHeroMatchups';
    const URI_GET_PLAYER_HEROES = 'getPlayerHeroes';

    private $availableEndpoints = [
        self::URI_GET_HEROES => 'heroes',
        self::URI_GET_HERO_MATCHUPS => 'heroes/' . self::PARAMTER_PLACEHOLDER . '/matchups',
        self::URI_GET_PLAYER_HEROES => 'players/' . self::PARAMTER_PLACEHOLDER . '/heroes'
    ];
    private $connection;

    protected function doRequest(string $endpoint, string $inlineParameter = null, array $parameters = []): stdClass
    {
        if (!$this->endpointAvailable($endpoint)) {
            throw new EndpointNotAvailableException('Endpoint "' . $endpoint . '" is not available at this point.');
        }

        $this->connection = curl_init();
        curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($this->connection, CURLOPT_URL, $this->formatUrl($endpoint, $inlineParameter, $parameters));
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

    private function formatUrl(string $endpoint, string $inlineParameter = null, array $parameters = []): string
    {
        $url = self::HOSTNAME . !empty($inlineParameter) ? $this->setInlineParameter($endpoint, $inlineParameter) : $endpoint;
        
        if (!empty($parameters)) {
            $url .= $this->renderParameters($parameters);
        }
        
        return $url;
    }
    
    private function setInlineParameter(string $endpoint, string $inlineParameter)
    {
        return str_replace(self::PARAMTER_PLACEHOLDER, $inlineParameter, $endpoint);
    }
    
    private function renderParameters(array $parameters)
    {
        return http_build_query($parameters);
    }
}
