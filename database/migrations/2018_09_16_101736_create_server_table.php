<?php

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
        Schema::create('modes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('name');
            $table->string('description');
            $table->timestamp('created_at');
            $table->index(['tag', 'name']);
            $table->unique(['tag', 'name']);
        });

        DB::table('modes')->insert([[
            'tag' => 're',
            'name' => 'renewal',
            'description' => 'This listing is based on renewal format',
            'created_at' => now(),
        ], [
            'tag' => 'pre-re',
            'name' => 'pre-renewal',
            'description' => 'This listing is based on pre-renewal format',
            'created_at' => now(),
        ], [
            'tag' => 'custom',
            'name' => 'custom',
            'description' => 'This listing uses a custom format.',
            'created_at' => now(),
        ], [
            'tag' => 'classic',
            'name' => 'classic',
            'description' => 'This listing uses a classic format.',
            'created_at' => now(),
        ],
        ]);

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('name');
            $table->string('description');
            $table->timestamp('created_at');
            $table->index(['tag', 'name']);
            $table->unique(['tag', 'name']);
        });

        DB::table('tags')->insert([[
            'tag' => 'freebies',
            'name' => 'Freebies',
            'description' => 'Players can obtain starting items once they login or from Newbie NPC.',
            'created_at' => now(),
        ],
        [
            'tag' => 'gepard',
            'name' => 'Gepard Protection',
            'description' => 'This listing supports anti-bot and anti-hack software.',
            'created_at' => now(),
        ], [
            'tag' => 'g-pack',
            'name' => 'Guild Pack',
            'description' => 'A guild can obtain a large amount of freebies for their members.',
            'created_at' => now(),
        ], [
            'tag' => 'pk',
            'name' => 'PK Mode',
            'description' => 'Players are able to engage in player vs player in all areas except towns.',
            'created_at' => now(),
        ], [
            'tag' => 'mobile',
            'name' => 'Mobile Support',
            'description' => 'This server can be installed, played and enjoyed on Android Devices.',
            'created_at' => now(),
        ], [
            'tag' => 'frost',
            'name' => 'Frost Server',
            'description' => 'Players are affected by Freeze effect.',
            'created_at' => now(),
        ], [
            'tag' => 'no donations',
            'name' => 'No Donations',
            'description' => 'Players are unable to obtain items through donation methods.',
            'created_at' => now(),
        ], [
            'tag' => 'instant level',
            'name' => 'Instant Level',
            'description' => 'Players can chose a class and max out base and job levels instantly by login or by NPC.',
            'created_at' => now(),
        ], [
            'tag' => 'themed server',
            'name' => 'Themed Server',
            'description' => 'A server that has a heavy theme and/or lots of roleplay and storytelling.',
            'created_at' => now(),
        ],
        ]);

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
            $table->string('slug');
            $table->json('configs');
            $table->string('background');
            $table->longText('description');
            $table->string('website');
            $table->unsignedInteger('mode_id');
            $table->string('accent')->default('nightmare');
            $table->unsignedInteger('language_id')->default(1);
            $table->double('episode')->nullable();
            $table->timestamps();
            $table->index(['episode']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('mode_id')->references('id')->on('modes')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('listing_languages')->onUpdate('cascade');
        });

        Schema::create('listing_tag', function (Blueprint $table) {
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('tag_id');
            $table->primary(['listing_id', 'tag_id']);
            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
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
            $table->unsignedInteger('publisher_id');
            $table->ipAddress('ip_address');
            $table->text('message');
            $table->smallInteger('donation_score');
            $table->smallInteger('update_score');
            $table->smallInteger('class_score');
            $table->smallInteger('item_score');
            $table->smallInteger('support_score');
            $table->smallInteger('hosting_score');
            $table->smallInteger('content_score');
            $table->smallInteger('event_score');
            $table->timestamps();
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
