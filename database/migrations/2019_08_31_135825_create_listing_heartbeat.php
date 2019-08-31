<?php

use App\Listings\Listing;
use App\Listings\ListingHeartbeat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateListingHeartbeat
 */
class CreateListingHeartbeat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_heartbeats', function (Blueprint $table) {
            $table->unsignedInteger('listing_id');
            $table->string('recorder')->default('none');
            $table->string('login')->default('offline');
            $table->string('char')->default('offline');
            $table->string('map')->default('offline');
            $table->unsignedInteger('players')->default('0');
            $table->timestamps();
        });

        /** @var Listing $listing */
        foreach (Listing::all() as $listing) {
            $listing->heartbeat()->save(new ListingHeartbeat);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_heartbeats');
    }
}
