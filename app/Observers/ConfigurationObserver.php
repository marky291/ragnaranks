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
        $configuration->setAttribute('rate', $this->getRateTitleFrom($configuration->base_exp_rate));
    }

    /**
     * Handle the app listings listing "updating" event.
     *
     * @param ListingConfiguration $configuration
     * @return void
     */
    public function updating(ListingConfiguration $configuration)
    {
        $configuration->setAttribute('rate', $this->getRateTitleFrom($configuration->base_exp_rate));
    }

    /**
     * Since we need this logic for EVERY listing, lets just observe changes
     * and apply it in the database to the model, save l33t millisecond loads.
     *
     * @param int $base_exp
     * @return string
     */
    private function getRateTitleFrom(int $base_exp): string
    {
        if ($base_exp < config('filter.exp.low-rate.min')) {
            return 'Official Rate';
        }
        if ($base_exp <= config('filter.exp.low-rate.max')) {
            return 'Low Rate';
        }
        if ($base_exp <= config('filter.exp.mid-rate.max')) {
            return 'Mid Rate';
        }
        if ($base_exp <= config('filter.exp.high-rate.max')) {
            return 'High Rate';
        }

        return 'Super High Rate';
    }
}
