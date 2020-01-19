<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingWebsiteStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_website_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->string('website');
            $table->integer('status');
            $table->text('reason');
            $table->timestamps();
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_status');
    }
}
