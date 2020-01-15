<?php

namespace App\Heartbeats;

use SimpleXMLElement;

/**
 * Interface StatusPropertiesInterface
 *
 * @package App\Heartbeats
 */
interface InformerResults
{
    /**
     * The uri where the data will live.
     *
     * @return string
     */
    public function getURI(): string;

    /**
     * Format the data to json response
     *
     * @return boolean
     */
    public function getLoginStatus(): bool;

    /**
     * Format the data to json response
     *
     * @return boolean
     */
    public function getCharStatus(): bool;

    /**
     * Format the data to json response
     *
     * @return boolean
     */
    public function getMapStatus(): bool;

    /**
     * Get the player count from service.
     *
     * @return integer
     */
    public function getPlayerCount(): int;

    /**
     * @param string $element
     * @return array
     */
    public function parseWebsiteResponse(string $element): array;
}
