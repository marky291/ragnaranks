<?php


namespace App\Listings;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ListingWebsiteConnector
 *
 * @package App\Listings
 */
class ListingWebsiteConnector
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var float
     */
    public static $timeout = 3.14;
    /**
     * @var string
     */
    public static $agent = 'Ragnaranks Website Status Check';
    /**
     * @var Listing
     */
    private $listing;

    /**
     * ListingWebsiteConnector constructor.
     *
     * @param Listing $listing
     */
    public function __construct(Listing $listing)
    {
        $this->client = new Client(['connect_timeout' => self::$timeout, 'User-Agent' => self::$agent]);

        $this->listing = $listing;
    }

    /**
     * Create a connection response from the listing.
     *
     * @return Response|ResponseInterface|null
     */
    public function getConnectionResponse(): Response
    {
        $response = null;

        try {
            $response = $this->client->get($this->listing->website);
        }
        catch (ClientException $exception)
        {
            $response = new Response($exception->getResponse()->getStatusCode());
        }
        catch (Exception $exception)
        {
            $response = new Response(400); // malformed or incorrect.
        }

        return $response;
    }
}
