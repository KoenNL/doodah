<?php
namespace App\Service;

use App\Document\OpenDotaApiResponse;
use App\Exception\EndpointNotAvailableException;
use \App\Transformer\OpenDotaObjectTransformer;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
    private $transformer;

    public function __construct(OpenDotaObjectTransformer $transformer)
    {
        $this->connection = HttpClient::create();
        $this->transformer = $transformer;
    }

    /**
     * @param string $endpoint
     * @param string|null $inlineParameter
     * @param array $parameters
     * @return OpenDotaApiResponse
     * @throws EndpointNotAvailableException
     */
    protected function doRequest(string $endpoint, string $inlineParameter = null, array $parameters = []): OpenDotaApiResponse
    {
        if (!$this->endpointAvailable($endpoint)) {
            throw new EndpointNotAvailableException('Endpoint "' . $endpoint . '" is not available at this point.');
        }

        $openDotaApiResponse = new OpenDotaApiResponse($endpoint);

        try {
            $response = $this->connection->request('GET', $this->formatUrl($endpoint, $inlineParameter), $parameters);

            if ($response->getStatusCode() === Response::HTTP_OK && json_decode($response->getContent())) {
                $openDotaApiResponse->setSuccess(true);
                $openDotaApiResponse->setResults($this->transformer->transformAll(json_decode($response->getContent())));
            }
        } catch (ClientExceptionInterface $exception) {
            $openDotaApiResponse->setException($exception);
        } catch (RedirectionExceptionInterface $exception) {
            $openDotaApiResponse->setException($exception);
        } catch (ServerExceptionInterface $exception) {
            $openDotaApiResponse->setException($exception);
        } catch (TransportExceptionInterface $exception) {
            $openDotaApiResponse->setException($exception);
        }

        return $openDotaApiResponse;
    }

    public function endpointAvailable(string $endpoint)
    {
        return !empty($this->availableEndpoints[$endpoint]);
    }

    private function formatUrl(string $endpoint, string $inlineParameter = null): string
    {
        $url = self::HOSTNAME . (!empty($inlineParameter) ? $this->setInlineParameter($endpoint, $inlineParameter) : $this->availableEndpoints[$endpoint]);
        
        return $url;
    }
    
    private function setInlineParameter(string $endpoint, string $inlineParameter)
    {
        return str_replace(self::PARAMTER_PLACEHOLDER, $inlineParameter, $this->availableEndpoints[$endpoint]);
    }
}
