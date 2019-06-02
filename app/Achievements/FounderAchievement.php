<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;
use Illuminate\Notifications\Notification;

class FounderAchievement extends Achievement
{
    /*
     * Whether this is a secret achievement or not.
     */
    public $secret = true;

    /*
     * The achievement name
     */
    public $name = 'Founder';

    /*
     * A small description for the achievement
     */
    public $description = 'For those who helped test and provide feedback during development';
}
