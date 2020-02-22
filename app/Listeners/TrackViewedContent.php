<?php

namespace App\Listeners;

use App\Viewable;
use App\Events\Viewed;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrackViewedContent implements ShouldQueue
{
    /**
     * @var Viewed
     */
    private $view;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Viewable $view)
    {
        $this->view = $view->byCurrentClientIP();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Viewed $event)
    {
        $event->model->views()->save($this->view);
    }
}
