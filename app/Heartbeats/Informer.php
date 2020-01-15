<?php

namespace App\Heartbeats;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class Checkup
 *
 * @package App\Heartbeats
 */
abstract class Informer implements InformerResults
{
    /**
     * The request response obtained from the website Url.
     *
     * @var Response
     */
    private $response;

    /**
     * The attributes accesible from the parsing of the panel.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Checkup constructor.
     * @todo: What if response is 404, and it continues to read
     *
     * @param string $website
     */
    public function __construct(string $website)
    {
        $this->response = (new Client)->get($website.$this->getURI(), ['connect_timeout' => 3.14]);

        $this->attributes = $this->tryParse($this->response->getBody()->getContents());
    }

    /**
     * Get the recorders name.
     * @return string
     */
    public function recorderName(): string
    {
        return class_basename($this);
    }

    /**
     * Validate if it is online.
     *
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->response->getStatusCode() == 200;
    }

    /**
     * Check for eligability of the informer then parse it.
     *
     * @param string $getContents
     * @return array
     */
    private function tryParse(string $getContents): array
    {
        if (!$this->isOnline() || !$this->hasMatchingContentType()) {
            return array();
        }

        return $this->parseWebsiteResponse($getContents);
    }

    /**
     * Did we find any data from the check?
     *
     * @return bool
     */
    public function hasActivePulse(): bool
    {
        return empty($this->attributes) == false;
    }

    /**
     * Check is the content type matching.
     *
     * @return bool
     */
    private function hasMatchingContentType(): bool
    {
        return $this->response->getHeader('Content-Type')[0] == $this->requiredContentType();
    }
}
