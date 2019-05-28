<?php

namespace App\Interactions;

class InteractionObserver
{
    /**
     * Handle the interaction "creating" event.
     *
     * @param \App\Interactions\Interaction $interaction
     * @return void
     */
    public function creating(Interaction $interaction)
    {
        if (auth()->check()) {
            $interaction->setAttribute('publisher_id', auth()->id());
        }

        if (is_null($interaction->getAttribute('ip_address'))) {
            $interaction->setAttribute('ip_address', request()->getClientIp());
        }
    }
}
