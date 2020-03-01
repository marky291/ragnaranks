<?php

namespace App\Notifications;

use App\Listings\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewListingCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Listing
     */
    private $listing;

    /**
     * Create a new notification instance.
     *
     * @param Listing $listing
     */
    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Listing!')
            ->line('A new listing has been posted to Ragnaranks.com:')
            ->line("Server: {$this->listing->name}")
            ->line("Owner: {$this->listing->user->email}")
            ->line("Listing: {$this->listing->route}")
            ->line("Creation: {$this->listing->created_at}");
    }
}
