<?php
namespace App\Service;

use App\Exception\EndpointNotAvailableException;
use stdClass;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

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

    public function __construct()
    {
        $this->connection = HttpClient::create();
    }
    
    protected function doRequest(string $endpoint, string $inlineParameter = null, array $parameters = []): stdClass
    {
        if (!$this->endpointAvailable($endpoint)) {
            throw new EndpointNotAvailableException('Endpoint "' . $endpoint . '" is not available at this point.');
        }

        $response = $this->connection->request('GET', $this->formatUrl($endpoint, $inlineParameter), $parameters);

        if ($response->getStatusCode === Response::HTTP_OK && json_decode($response->getContent())) {
            return $this->transformer->transform(json_decode($response->getContent()));
        }

        return false;
    }

    public function endpointAvailable(string $endpoint)
    {
        return empty($this->availableEndpoints[$endpoint]);
    }

    private function formatUrl(string $endpoint, string $inlineParameter = null): string
    {
        $url = self::HOSTNAME . !empty($inlineParameter) ? $this->setInlineParameter($endpoint, $inlineParameter) : $endpoint;
        
        return $url;
    }
    
    private function setInlineParameter(string $endpoint, string $inlineParameter)
    {
        return str_replace(self::PARAMTER_PLACEHOLDER, $inlineParameter, $endpoint);
    }
}
