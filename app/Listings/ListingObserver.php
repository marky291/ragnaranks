<?php

namespace App\Listings;

use App\Notifications\NewListingCreatedNotification;
use App\Notifications\NewUserJoinedNotification;
use App\User;
use Exception;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ListingObserver.
 */
class ListingObserver
{
    /**
     * Handle the app listings listing "created" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function created(Listing $listing): void
    {
        // create a listing ranking in the database.
        $listing->ranking()->save(new ListingRanking([
            'rank' => ListingRanking::query()->max('rank') + 1
        ]));

        // email about new listings being created to all admins.
        Notification::send(User::role('admin')->get(), new NewListingCreatedNotification($listing));
    }

    /**
     * Generate its unique space that will allow file uploading.
     *
     * @param Listing $listing
     */
    public function creating(Listing $listing): void
    {
        $listing->space = Str::uuid();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param Listing $listing
     * @return void
     * @throws Exception
     */
    public function updated(Listing $listing): void
    {
        cache()->forget("listing:{$listing->name}");
    }

    /**
     * Handle the app listings listing "creating" event.
     *
     * @param Listing $listing
     * @return void
     */
    public function saving(Listing $listing): void
    {
        $listing->slug = Str::slug($listing->name);
    }
}
