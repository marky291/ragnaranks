<?php

namespace App\Heartbeats;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Http\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class FluxControlPanelStatus extends Checkup implements StatusReadingInterface
{
    /**
     * The url that should be appended to the website name.
     *
     * @var string
     */
    public $append = '/?module=server&action=status-xml';

    /**
     * Check if a status exists on this interface.
     *
     * @return boolean
     */
    public function exists(): bool
    {
         return $this->response()->getHeader('content-type')[0] == 'text/xml;charset=UTF-8';
    }

    /**
     * Format the data to json response
     *
     * @return array
     */
    public function formattedData()
    {
        $contents = simplexml_load_string($this->response()->getBody()->getContents())->Group[0];

        if ($contents == null) {
            $data = [
                'login' => false,
                'char' => false,
                'map' => false,
                'players' => 0
            ];
        } else {
            $response = $contents->Server[0]->attributes();
            $data = [
                'login' => (bool) $response['loginServer'],
                'char' => (bool) $response['charServer'],
                'map' => (bool) $response['mapServer'],
                'players' => (int) $response['playersOnline']
            ];
        }

        return json_encode($data, true);
    }
}
