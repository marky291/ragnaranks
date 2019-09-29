<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReviewAverageScoreDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function(Blueprint $table) {
            $table->float('review_score')->change();
        });

        Schema::table('reviews', function(Blueprint $table) {
            $table->float('average_score')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function(Blueprint $table) {
            $table->double('review_score')->change();
        });

        Schema::table('reviews', function(Blueprint $table) {
            $table->double('average_score')->change();
        });
    }
}
