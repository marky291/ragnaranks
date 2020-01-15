<?php


namespace App\Heartbeats;


use App\Listings\Listing;
use App\Listings\ListingHeartbeat;

/**
 * Class HeartbeatMonitor
 *
 * @package App\Heartbeats
 */
class HeartbeatMonitor
{
    /**
     * @var Listing
     */
    private $listing;

    /**
     * @var InformerResults
     */
    private $informer;

    /**
     * @var array
     */
    private $pulseLocations = [
        FluxStatusInformer::class
    ];

    /**
     * HeartbeatMonitor constructor.
     *
     * @param Listing $listing
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;

        $this->findPulseReading();
    }

    /**
     * @return ListingHeartbeat
     */
    public function getHeartbeat(): ListingHeartbeat
    {
        return $this->listing->heartbeat;
    }

    /**
     * @return void
     */
    private function findPulseReading(): void
    {
        foreach ($this->pulseLocations as $pulse) {
            /** @var Informer $informer */
            $informer = new $pulse($this->listing->website);

            if ($informer->hasActivePulse()) {
                $this->informer = $informer;
                return;
            }
        }
    }

    /**
     * Do we have an informer to get data
     *
     * @return bool
     */
    public function hasInformer(): bool
    {
        return isset($this->informer) && $this->informer instanceof InformerResults;
    }
}
