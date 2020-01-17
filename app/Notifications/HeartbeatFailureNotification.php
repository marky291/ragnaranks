<?php

namespace App\Notifications;

use App\Listings\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HeartbeatFailureNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Listing
     */
    private $listing;
    /**
     * @var int
     */
    private $failureCount;

    /**
     * Create a new notification instance.
     *
     * @param Listing $listing
     * @param int $failureCount
     */
    public function __construct(Listing $listing, int $failureCount)
    {
        $this->listing = $listing;

        $this->failureCount = $failureCount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Heartbeat Failure!')
            ->line("We detected {$this->failureCount} invalid responses from {$this->listing->name}")
            ->line("Website: {$this->listing->website}")
            ->line("Listing: {$this->listing->route()}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
