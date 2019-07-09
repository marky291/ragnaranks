<?php

namespace App\Observers;

use App\Listings\Listing;
use App\Listings\ListingConfiguration;

class ConfigurationObserver
{
    /**
     * Handle the app listings listing "creating" event.
     *
     * @param ListingConfiguration $configuration
     * @return void
     */
    public function creating(ListingConfiguration $configuration)
    {
        $configuration->setAttribute('exp_title', $this->getRateTitleFrom($configuration->base_exp_rate));
    }

    /**
     * Handle the app listings listing "updating" event.
     *
     * @param ListingConfiguration $configuration
     * @return void
     */
    public function updating(ListingConfiguration $configuration)
    {
        $configuration->setAttribute('exp_title', $this->getRateTitleFrom($configuration->base_exp_rate));
    }

    /**
     * Since we need this logic for EVERY listing, lets just observe changes
     * and apply it in the database to the model, save l33t millisecond loads.
     *
     * @param int $base_exp
     * @return string
     */
    private function getRateTitleFrom($base_exp): string
    {
        if ($base_exp < config('filter.exp.low-rate.min')) {
            return 'official-rate';
        }
        if ($base_exp <= config('filter.exp.low-rate.max')) {
            return 'low-rate';
        }
        if ($base_exp <= config('filter.exp.mid-rate.max')) {
            return 'mid-rate';
        }
        if ($base_exp <= config('filter.exp.high-rate.max')) {
            return 'high-rate';
        }
        if ($base_exp > config('filter.exp.high-rate.max')) {
            return 'super-high-rate';
        }

        return 'unknown-rate';
    }
}
