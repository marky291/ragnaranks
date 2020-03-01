<?php

namespace App\Listings;

use DateInterval;
use DateTimeInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ListingWebsiteOfflineNotification
 *
 * @package App\Listings
 */
class ListingWebsiteOfflineNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Listing
     */
    private $listing;
    /**
     * @var int
     */
    private $countHours;
    /**
     * @var ListingWebsiteStatus
     */
    private $status;

    /**
     * Create a new notification instance.
     *
     * @param Listing $listing
     * @param ListingWebsiteStatus $status
     * @param int $countHours
     */
    public function __construct(Listing $listing, ListingWebsiteStatus $status, int $countHours)
    {
        $this->listing = $listing;

        $this->countHours = $countHours;

        $this->status = $status;
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
            ->subject('Listing website offline')
            ->line("We have been monitoring the website belonging to \n{$this->listing->name} and would like to notify you that it has been offline for {$this->countHours} hours!")
            ->line("The response received is {$this->status->status}, {$this->status->reason}")
            ->line('Our moderation team may remove the listing if it is believed you will no longer be online.')
            ->action('Check your Listing', $this->listing->route);
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
