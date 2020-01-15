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
     * We run a checkup on the website for its status.
     *
     * @var string
     */
    private $website;

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
     *
     * @param string $website
     */
    public function __construct(string $website)
    {
        $this->response = (new Client)->get($website.$this->getURI(), ['connect_timeout' => 3.14]);

        $this->attributes = $this->parseWebsiteResponse($this->response->getBody()->getContents());
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
     * Validate it is online.
     *
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->response->getStatusCode();
    }
}
