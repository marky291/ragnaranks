<?php

use App\Listings\Listing;
use App\Listings\ListingHeartbeat;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterHeartbeatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('listing_heartbeats');

        Schema::create('listing_heartbeats', static function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->string('informer');
            $table->boolean('login')->default(0);
            $table->boolean('char')->default(0);
            $table->boolean('map')->default(0);
            $table->integer('players')->default(0);
            $table->timestamps();
        });
    }
}
