<?php


namespace App\Heartbeats;


class CustomStatusInformer extends Informer
{

    /**
     * @inheritDoc
     */
    public function getInformerName(): string
    {
        return 'CustomCP';
    }

    /**
     * @inheritDoc
     */
    public function getURI(): string
    {
        return '/api/server-player-stats';
    }

    /**
     * @inheritDoc
     */
    public function getLoginStatus(): bool
    {
        return $this->attributes[1]->serverStatus == 2;
    }

    /**
     * @inheritDoc
     */
    public function getCharStatus(): bool
    {
        return $this->attributes[1]->serverStatus == 2;
    }

    /**
     * @inheritDoc
     */
    public function getMapStatus(): bool
    {
        return $this->attributes[1]->serverStatus == 2;
    }

    /**
     * @inheritDoc
     */
    public function getPlayerCount(): int
    {
        return $this->attributes[0][0]->players_online;
    }

    /**
     * @inheritDoc
     */
    public function requiredContentType(): string
    {
        return 'application/json; charset=utf-8';
    }

    /**
     * @inheritDoc
     */
    public function parseWebsiteResponse(string $element): array
    {
        return json_decode($element);
    }
}
