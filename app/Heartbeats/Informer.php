<?php

namespace App\Heartbeats;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

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
    protected $attributes = [];

    /**
     * The name that will be shown to websites as the crawler.
     *
     * @var string
     */
    public static $agentName = 'Ragnaranks Heartbeat Monitor';

    /**
     * Checkup constructor.
     * @todo: What if response is 404, and it continues to read
     *
     * @param string $website
     */
    public function __construct(string $website)
    {
        $this->response = $this->createResponseFrom($website);

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
        $allowedCodes = [200, 304]; // ok, not modified.

        return in_array($this->response->getStatusCode(), $allowedCodes, true);
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

    /**
     * @param string $website
     * @return ResponseInterface
     */
    private function createResponseFrom(string $website): ResponseInterface
    {
        $client = new Client(['connect_timeout' => 3.14, 'User-Agent' => self::$agentName]);

        try {
            return $client->get($website . $this->getURI(), ['connect_timeout' => 3.14]);
        }
        catch (ConnectException $exception)
        {
            return new Response(400); // malformed or incorrect.
        }
        catch (ClientException $exception)
        {
            return new Response($exception->getResponse()->getStatusCode());
        }
        catch (RequestException $exception)
        {
            return new Response(400); // malformed or incorrect.
        }
    }
}
