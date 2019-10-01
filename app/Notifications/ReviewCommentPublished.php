<?php

namespace App\Notifications;

use App\Reviews\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReviewCommentPublished extends Notification implements ShouldQueue
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
            'title' => 'Comment was made on a review you made!',
            'message' => 'A response has been made to your review by the Server Owner.',
            'link' => "/listing/{$this->review->listing->slug}",
        ];
    }
}
