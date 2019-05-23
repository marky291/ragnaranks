<?php

namespace App\Notifications;

use App\Listings\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReviewPublished extends Notification
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
        return ['database'];
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
            'title' => 'Listing received a review',
            'message' => 'A user has just left a review on your server listing. If you find this or any reviews made on your listing to be breaking review guidelines, please use the report option found at the bottom of the review.',
            'link' => "/listing/{$this->listing->slug}"
        ];
    }
}
