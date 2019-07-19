<?php

use App\Tag;
use App\Listings\ListingLanguage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamp('created_at');
        });

        /*
         * Use the trans array for generating available tags
         */
        foreach (array_keys(trans('homepage.tag')) as $tag) {
            (new Tag(['name' => $tag]))->save();
        }

        Schema::create('listing_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        (new ListingLanguage(['name' => 'english']))->save();
        (new ListingLanguage(['name' => 'french']))->save();
        (new ListingLanguage(['name' => 'german']))->save();
        (new ListingLanguage(['name' => 'irish']))->save();
        (new ListingLanguage(['name' => 'portuguese']))->save();
        (new ListingLanguage(['name' => 'malaysian']))->save();
        (new ListingLanguage(['name' => 'mandarin']))->save();
        (new ListingLanguage(['name' => 'russian']))->save();
        (new ListingLanguage(['name' => 'spanish']))->save();
        (new ListingLanguage(['name' => 'tagalog']))->save();

        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('slug')->index();
            $table->text('background');
            $table->longText('description');
            $table->string('website');
            $table->string('mode');
            $table->string('accent')->default('nightmare');
            $table->unsignedInteger('language_id')->default(1);
            $table->smallInteger('review_score')->default(0);
            $table->double('episode')->nullable();
            $table->timestamps();
            $table->index(['episode']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('listing_languages')->onUpdate('cascade');
        });

        Schema::create('listing_tag', function (Blueprint $table) {
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('tag_id');
            $table->primary(['listing_id', 'tag_id']);
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('listing_rankings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('rank');
            $table->unsignedInteger('points')->default(0);
            $table->unsignedInteger('votes')->default(0);
            $table->unsignedInteger('clicks')->default(0);
            $table->timestamp('updated_at');
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('listing_configurations', function (Blueprint $table) {
            $table->unsignedInteger('listing_id')->unique();
            $table->string('exp_title')->index();
            $table->integer('max_base_level')->default(0);
            $table->integer('max_job_level')->default(0);
            $table->integer('max_stats')->default(0);
            $table->integer('max_aspd')->default(0);
            $table->integer('base_exp_rate')->default(0)->index(); // for exp title searching
            $table->integer('job_exp_rate')->default(0);
            $table->integer('quest_exp_rate')->default(0);
            $table->boolean('instant_cast_stat')->default(0);
            $table->boolean('pk_mode')->default(0);
            $table->boolean('castrate_dex_scale')->default(0);
            $table->boolean('arrow_decrement')->default(0);
            $table->boolean('undead_detect_type')->default(0);
            $table->boolean('attribute_recover')->default(0);
            $table->integer('item_drop_common')->default(0);
            $table->integer('item_drop_equip')->default(0);
            $table->integer('item_drop_card')->default(0);
            $table->integer('item_drop_common_mvp')->default(0);
            $table->integer('item_drop_equip_mvp')->default(0);
            $table->integer('item_drop_card_mvp')->default(0);
            $table->timestamp('updated_at');
        });

        Schema::create('listing_screenshots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->string('link');
            $table->timestamps();
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('listing_id')->index();
            $table->ipAddress('ip_address');
            $table->text('message');
            $table->smallInteger('average_score');
            $table->smallInteger('donation_score');
            $table->smallInteger('update_score');
            $table->smallInteger('class_score');
            $table->smallInteger('item_score');
            $table->smallInteger('support_score');
            $table->smallInteger('hosting_score');
            $table->smallInteger('content_score');
            $table->smallInteger('event_score');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('listing_id')->references('id')->on('listings');
        });

        Schema::create('review_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('review_id');
            $table->longText('message');
            $table->timestamps();
        });

        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id');
            $table->ipAddress('ip_address')->index();
            $table->timestamp('created_at');
            $table->foreign('listing_id')->references('id')->on('listings');
            $table->index(['listing_id', 'created_at']);
        });

        Schema::create('clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id')->index();
            $table->ipAddress('ip_address');
            $table->timestamp('created_at');
            $table->foreign('listing_id')->references('id')->on('listings');
            $table->index(['listing_id', 'created_at']);
        });

        Schema::create('interactions', function (Blueprint $table) {
            $table->unsignedBigInteger('interaction_id');
            $table->unsignedInteger('listing_id');
            $table->string('interaction_type');
            $table->index(['interaction_type', 'interaction_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing');
    }
}
