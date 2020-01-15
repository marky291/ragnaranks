<?php

namespace App\Heartbeats;

/**
 * Interface StatusPropertiesInterface
 *
 * @package App\Heartbeats
 */
interface InformerResults
{
    /**
     * The name to appear as informer
     *
     * @return string
     */
    public function getInformerName(): string;

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
     * Check if we can parse the content type.
     *
     * @return string
     */
    public function requiredContentType(): string;

    /**
     * @param string $element
     * @return array
     */
    public function parseWebsiteResponse(string $element): array;
}
