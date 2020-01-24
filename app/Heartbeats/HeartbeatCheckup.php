<?php


namespace App\Heartbeats;


use App\Listings\Listing;
use App\Listings\ListingHeartbeat;

/**
 * Class HeartbeatMonitor
 *
 * @package App\Heartbeats
 */
class HeartbeatCheckup
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
        FluxStatusInformer::class,
        CustomStatusInformer::class,
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
     * @return void
     */
    private function findPulseReading(): void
    {
        foreach ($this->pulseLocations as $pulse) {
            /** @var Informer $informer */
            $informer = (new $pulse);
            $informer->scrape($this->listing->website);
            if ($informer->hasActivePulse()) {
                $this->informer = $informer;
                return;
            }
        }

        // did one exist before?
        if ($this->hasPreviousHeartbeat()) {
            $this->informer = new OfflineStatusInformer;
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

    /**
     * @return InformerResults
     */
    public function getInformer():InformerResults
    {
        return $this->informer;
    }

    /**
     * Create and save a new heartbeat from the informer we found.
     *
     * @return ListingHeartbeat
     */
    public function recordResults(): ListingHeartbeat
    {
        $heartbeat = new ListingHeartbeat();

        $heartbeat->fillInformerResults($this->informer);

        $this->listing->heartbeats()->save($heartbeat);

        return $heartbeat;
    }

    /**
     * @return bool
     */
    private function hasPreviousHeartbeat(): bool
    {
        return $this->listing->heartbeat !== null;
    }
}
