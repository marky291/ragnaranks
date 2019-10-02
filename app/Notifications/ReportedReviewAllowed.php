<?php

namespace App\Notifications;

use App\Report;
use App\Reviews\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReportedReviewAllowed extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var Review
     */
    private $report;

    /**
     * Create a new notification instance.
     * @param Report $report
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
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
            'title' => 'Action taken on a review you reported!',
            'message' => "The review you reported {$this->report->created_at->diffForHumans()} was deemed acceptable by the moderation team",
        ];
    }
}
