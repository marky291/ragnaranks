<?php

namespace App\Listings;

use App\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

/**
 * Class ListingWebsiteStatusMonitor
 *
 * @package App\Listings
 */
class ListingWebsiteStatusMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:monitor';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check listing websites for status';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $listings = Listing::all();

        /** @var Listing $listing */
        foreach ($listings as $listing) {

            $this->info("Connecting to {$listing->website}");
            $connection = new ListingWebsiteConnector($listing);
            $response = $connection->getConnectionResponse();

            if (isset($response)) {
                $status = $response->getStatusCode();
                $websiteStatus = new ListingWebsiteStatus([
                    'website' => $listing->website,
                    'status' => $status,
                    'reason' => $response->getReasonPhrase(),
                ]);
                $listing->websiteStatus()->save($websiteStatus);

                if ($this->isNotOk($status)) {
                    $this->returnedInvalidResponse($listing, $response);
                } else {
                    $this->info("Website response returned {$status}");
                }
            }
        }

        return true;
    }

    /**
     * @param Listing $listing
     * @param Response $response
     */
    private function returnedInvalidResponse(Listing $listing, Response $response): void
    {
        $hoursAllowedOffline = 24;

        $this->warn("Website returned status {$response->getStatusCode()}");

        // attempt to get last hours of being offline responses.
        /** @var Collection $responses */
        // was the hour before it also offline?
        $responses = $listing->websiteStatus()->offline()->hours($hoursAllowedOffline+1)->get();
        $totalResponses = $responses->count();

        // if so, we dont run it.
        if ($totalResponses == $hoursAllowedOffline) {
            Notification::send(
                User::role('admin')->get()->merge($listing->user),
                (new ListingWebsiteOfflineNotification($listing, $responses->first(), $hoursAllowedOffline))->delay(now()->seconds(30))
            );
        }
    }

    /**
     * @param int $status
     * @return bool
     */
    private function isNotOk(int $status): bool
    {
        return $status !== 200;
    }
}
