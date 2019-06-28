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
            $interaction->setAttribute('user_id', auth()->id());
        }

        if ($interaction->getAttribute('ip_address') === null) {
            $interaction->setAttribute('ip_address', request()->getClientIp());
        }
    }
}
