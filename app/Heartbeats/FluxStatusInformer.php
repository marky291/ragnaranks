<?php

namespace App\Heartbeats;

/**
 * Class FluxMonitor
 *
 * @package App\Heartbeats
 */
class FluxStatusInformer extends Informer
{
    /**
     * @inheritDoc
     */
    public function getURI(): string
    {
        return '/?module=server&action=status-xml';
    }

    /**
     * @inheritDoc
     */
    public function getLoginStatus(): bool
    {
        return $this->attributes['loginServer'];
    }

    /**
     * @inheritDoc
     */
    public function getCharStatus(): bool
    {
        return $this->attributes['charServer'];
    }

    /**
     * @inheritDoc
     */
    public function getMapStatus(): bool
    {
        return (bool) $this->attributes['mapServer'];
    }

    /**
     * @inheritDoc
     */
    public function getPlayerCount(): int
    {
        return $this->attributes['playersOnline'];
    }

    /**
     * @inheritDoc
     */
    public function parseWebsiteResponse(string $element): array
    {
        $xml = simplexml_load_string($element);

        $json = json_encode($xml);

        $raw = json_decode($json, true);

        return $raw['Group']['Server']['@attributes'];
    }
}
