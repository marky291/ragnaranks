<?php

namespace App\Notifications;

use App\Interactions\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReviewCommentPublished extends Notification
{
    use Queueable;

    /**
     * @var Review
     */
    private $review;

    /**
     * Create a new notification instance.
     *
     * @param Review $review
     */
    public function __construct(Review $review)
    {
        $this->review = $review;
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
            'title' => 'Comment was made on a review',
            'message' => 'Your review.......',
            'link' => "/listing/{$this->review->listing->slug}"
        ];
    }
}
