<?php

namespace App\Heartbeats;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Checkup
 *
 * @package App\Heartbeats
 */
abstract class Checkup
{
    /**
     * We run a checkup on the website for its status.
     *
     * @var string
     */
    protected $website;

    /**
     * The url that should be appended to the website name.
     *
     * @var string
     */
    public $append = '';

    /**
     * Checkup constructor.
     *
     * @param string $websiteName
     */
    public function __construct(string $websiteName)
    {
        $this->website = $websiteName;
    }

    /**
     * Generate a response for the status connection.
     *
     * @return ResponseInterface
     */
    public function response(): ResponseInterface
    {
        if ($this->website == 'https://www.facebook.com/Spark-Ragnarok-Online-2442046062747934/') {
            dd((new Client)->get($this->website . $this->append));
        }
        return $this->response ?? (new Client)->get($this->website . $this->append);
    }
}
