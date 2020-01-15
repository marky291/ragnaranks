<?php

namespace App\Notifications;

use App\Listings\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServerHasGoneOfflineNotification extends Notification implements ShouldQueue
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
            ->subject("{$this->listing->name} is offline!")
            ->line("We just wanted to let you know, we detected downtime on {$this->listing->name} within the last 10 minutes.")
            ->line('We also wish to thank you for your continued support at https://ragnaranks.com')
            ->action('Your Website', $this->listing->website);
    }
}
