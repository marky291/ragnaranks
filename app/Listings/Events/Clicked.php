<?php

namespace App\Listings\Events;

use App\Listings\Listing;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class Clicked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Listing
     */
    public $listing;

    /**
     * Create a new event instance.
     *
     * @param Listing $listing
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
