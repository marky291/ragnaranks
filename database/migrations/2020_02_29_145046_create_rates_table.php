<?php

use App\Rate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->integer('min');
            $table->integer('max');
            $table->timestamps();
        });

        (new Rate(['name' => 'official-rate', 'min' => 0, 'max' => 5]))->save();
        (new Rate(['name' => 'low-rate', 'min' => 6, 'max' => 50]))->save();
        (new Rate(['name' => 'mid-rate', 'min' => 51, 'max' => 300]))->save();
        (new Rate(['name' => 'high-rate', 'min' => 301, 'max' => 5000]))->save();
        (new Rate(['name' => 'super-high-rate', 'min' => 5001, 'max' => 999999999]))->save();

        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedInteger('mode_id')->after('mode')->default(1);
        });

        foreach (\App\Listings\Listing::withTrashed()->get() as $listing) {
            $mode = \App\Mode::where('name', $listing->mode)->first();
            $listing->mode()->associate($mode)->save();
        }

        Schema::table('listings', function(Blueprint $table) {
            $table->dropColumn('mode');
        });

        Schema::table('listings', function(Blueprint $table) {
            $table->unsignedInteger('rate_id')->after('mode_id')->default(1);
        });

        foreach (\App\Listings\Listing::with('configuration')->withTrashed()->get() as $listing) {
            $rate = Rate::where('name', $listing->configuration->exp_title)->first();
            $listing->rate()->associate($rate)->save();
        }

        Schema::table('listing_configurations', function(Blueprint $table) {
            $table->dropColumn('exp_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('rates');
//
//        Schema::table('listings', function(Blueprint $table) {
//            $table->dropColumn('mode_id');
//        });
    }
}
