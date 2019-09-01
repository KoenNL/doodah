<?php
namespace App\Document;

use Exception;

class OpenDotaApiResponse
{

    private $endpoint;
    private $success;
    private $exception;
    private $results;

    /**
     * OpenDotaApiResponse constructor.
     * @param string $endpoint
     * @param bool $success
     * @param Exception $exception
     * @param array $results
     */
    public function __construct(string $endpoint, bool $success = false, Exception $exception = null, array $results = [])
    {
        $this->endpoint = $endpoint;
        $this->success = $success;
        $this->exception = $exception;
        $this->results = $results;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     * @return OpenDotaApiResponse
     */
    public function setEndpoint(string $endpoint): OpenDotaApiResponse
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     * @return OpenDotaApiResponse
     */
    public function setSuccess(bool $success): OpenDotaApiResponse
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasException(): bool
    {
        return !empty($this->exception);
    }

    /**
     * @return Exception
     */
    public function getException(): Exception
    {
        return $this->exception;
    }

    /**
     * @param Exception $exception
     * @return OpenDotaApiResponse
     */
    public function setException(Exception $exception): OpenDotaApiResponse
    {
        $this->exception = $exception;
        return $this;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     * @return OpenDotaApiResponse
     */
    public function setResults(array $results): OpenDotaApiResponse
    {
        $this->results = $results;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getResult()
    {
        if (count($this->results) === 1) {
            return $this->results[0];
        }

        return $this->results;
    }
}