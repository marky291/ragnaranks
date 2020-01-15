<?php

namespace Tests\Feature;

use App\Console\Commands\CheckHeartbeats;
use App\Heartbeats\Informer;
use App\Heartbeats\FluxMonitor;
use App\Listings\Listing;
use App\Notifications\HeartbeatFailureNotification;
use App\Notifications\ServerHasGoneOfflineNotification;
use App\Notifications\WelcomeNotification;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConsoleHeartbeatTest extends TestCase
{

    public function test_flux_control_data_response()
    {
        $checkup = new FluxMonitor('https://xilero.net/');

        $decoded = json_decode($checkup->formattedData(), true);

        $this->assertTrue($decoded['login']);
    }

    public function test_heartbeat_response_valid_stored_succesfull_heartbeat_count()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['website' => 'https://xilero.net']);

        $this->artisan('check:heartbeat')->expectsOutput('Completed heartbeat checkup successfully');

        $this->assertDatabaseHas('listing_heartbeats', ['listing_id' => 1, 'success_count' => 1]);
    }

    public function test_heartbeat_response_valid_stores_multiple_success_counts()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['website' => 'https://xilero.net']);


        $this->artisan('check:heartbeat')->expectsOutput('Completed heartbeat checkup successfully');
        $this->artisan('check:heartbeat')->expectsOutput('Completed heartbeat checkup successfully');
        $this->artisan('check:heartbeat')->expectsOutput('Completed heartbeat checkup successfully');

        $this->assertDatabaseHas('listing_heartbeats', ['listing_id' => 1, 'success_count' => 3]);
    }

    public function test_heartbeat_response_valid_stored_failure_heartbeat_count()
    {
        /** @var Listing $listing */
        $listing = factory(Listing::class)->create(['website' => 'fakeererrr/db']);
        $listing->heartbeat()->update(['recorder' => 'flux-cp']);
        $this->artisan('check:heartbeat')->expectsOutput('Completed heartbeat checkup successfully');

        $this->assertDatabaseHas('listing_heartbeats', ['listing_id' => 1, 'failure_count' => 1]);
    }

    public function test_heartbeat_36_failures_notifys_admins()
    {
        Notification::fake();

        $this->signIn(); // create admin account.
        $listing = factory(Listing::class)->create(['website' => 'fakeererrr/db']);
        $listing->heartbeat()->update(['recorder' => 'flux-cp', 'failure_count' => 143]);
        $this->artisan('check:heartbeat')->expectsOutput('Completed heartbeat checkup successfully');

        Notification::assertTimesSent(1, HeartbeatFailureNotification::class);
    }

    public function test_heaRtbeat_notifies_server_owner_if_server_goes_offline()
    {
        Notification::fake();

        $listing = factory(Listing::class)->create(['website' => 'http://esper-ro.com/']);

        $listing->heartbeat()->update(['recorder' => 'flux-cp', 'failure_count' => 0]);

        $listing->user()->update(['email' => 'marky360@live.ie']);

        (new CheckHeartbeats())->checkListingHeartbeat($listing);

        Notification::assertTimesSent(1, ServerHasGoneOfflineNotification::class);
    }
}
