<?php


namespace App\Heartbeats;


class OfflineStatusInformer extends Informer
{
    /**
     * @inheritDoc
     */
    public function getInformerName(): string
    {
        return 'Offline';
    }

    /**
     * @inheritDoc
     * @throws InformerLogicException
     */
    public function getURI(): string
    {
        throw new InformerLogicException('No URI to process for offline status');
    }

    /**
     * @inheritDoc
     */
    public function getLoginStatus(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getCharStatus(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getMapStatus(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getPlayerCount(): int
    {
        return 0;
    }

    /**
     * @inheritDoc
     * @throws InformerLogicException
     */
    public function requiredContentType(): string
    {
        throw new InformerLogicException('Cannot get required type from offline status');
    }

    /**
     * @inheritDoc
     * @throws InformerLogicException
     */
    public function parseWebsiteResponse(string $element): array
    {
        throw new InformerLogicException('Cannot parse website response from offline status');
    }
}
