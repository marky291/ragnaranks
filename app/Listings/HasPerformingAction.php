<?php


namespace App\Listings;


trait HasPerformingAction
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootHasPerformingAction()
    {
        static::creating(static function(Interaction $interaction) {
            if (auth()->check()) {
                $interaction->setAttribute('user_id', auth()->id());
            }
            if ($interaction->getAttribute('ip_address') === null) {
                $interaction->setAttribute('ip_address', request()->getClientIp());
            }
        });
    }
}
