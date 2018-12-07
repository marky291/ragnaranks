<?php

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
        Schema::create('servers_modes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('tag');
            $table->string('name');
            $table->string('description');
            $table->timestamp('created_at');
            $table->index(['tag', 'name']);
            $table->unique(['tag', 'name']);
        });

        DB::table('servers_modes')->insert([[
            'tag' => 're',
            'name' => 'renewal',
            'description' => 'This server is based on renewal format',
            'created_at' => now(),
        ],[
            'tag' => 'pre-re',
            'name' => 'pre-renewal',
            'description' => 'This server is based on pre-renewal format',
            'created_at' => now(),
        ], [
            'tag' => 'custom',
            'name' => 'custom',
            'description' => 'This server uses a custom format.',
            'created_at' => now(),
        ], [
            'tag' => 'classic',
            'name' => 'classic',
            'description' => 'This server uses a classic format.',
            'created_at' => now(),
        ]
        ]);

        Schema::create('tags', function(Blueprint $table) {
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
            'description' => 'Players can obtain starting items once they login.',
            'created_at' => now(),
        ],
        [
            'tag' => 'gepard',
            'name' => 'Gepard Protection',
            'description' => 'This server supports anti-bot and anti-hack software.',
            'created_at' => now(),
        ],[
            'tag' => 'g-pack',
            'name' => 'Guild Pack',
            'description' => 'A guild can obtain a large amount of freebies for their members once they login.',
            'created_at' => now(),
        ],[
            'tag' => 'pk',
            'name' => 'PK Mode',
            'description' => 'Players are able to engage in player vs player in all areas except towns.',
            'created_at' => now(),
        ],[
            'tag' => 'android',
            'name' => 'Android Support',
            'description' => 'This server can be installed, played and enjoyed on Android Devices.',
            'created_at' => now(),
        ],[
            'tag' => 'frost',
            'name' => 'Frost Server',
            'description' => 'Players can obtain starting items once they login.',
            'created_at' => now(),
        ],[
            'tag' => 'no donations',
            'name' => 'No Donations',
            'description' => 'Players are unable to obtain items through donation methods.',
            'created_at' => now(),
        ]
        ]);

        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rank')->default(0);
            $table->integer('rank_growth')->default(0);
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('banner_url');
            $table->longText('description');
            $table->string('website');
            $table->unsignedInteger('mode_id');
            $table->double('episode')->nullable();
            $table->integer('votes_count')->default(0);
            $table->double('votes_trend')->default(0);
            $table->integer('clicks_count')->default(0);
            $table->double('clicks_trend')->default(0);
            $table->timestamps();
            $table->index(['rank', 'votes_count', 'clicks_count', 'episode']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('mode_id')->references('id')->on('servers_modes')->onUpdate('cascade');
        });

        Schema::create('servers_tags', function(Blueprint $table) {
            $table->unsignedInteger('server_id');
            $table->unsignedInteger('tag_id');
            $table->primary(['server_id', 'tag_id']);
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('servers_reports', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_id');
            $table->integer('votes_count')->default(0);
            $table->integer('clicks_count')->default(0);
            $table->timestamps();
            $table->index(['created_at']);
            $table->foreign('server_id')->references('id')->on('servers')->onUpdate('cascade')->onDate('cascade');
        });

        Schema::create('servers_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_id');
            $table->ipAddress('ip_address');
            $table->timestamp('created_at');
            $table->index(['created_at', 'server_id']);
            $table->foreign('server_id')->references('id')->on('servers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('servers_clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_id');
            $table->ipAddress('ip_address');
            $table->timestamp('created_at');
            $table->index(['created_at', 'server_id']);
            $table->foreign('server_id')->references('id')->on('servers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('servers_configs', function(Blueprint $table)
        {
            $table->unsignedInteger('server_id');
            $table->integer('max_base_level')->nullable();
            $table->integer('max_job_level')->nullable();
            $table->integer('max_stats')->nullable();
            $table->integer('max_aspd')->nullable();
            $table->integer('base_exp_rate');
            $table->integer('job_exp_rate');
            $table->integer('instant_cast_stat')->nullable();
            $table->integer('drop_base_rate')->nullable();
            $table->integer('drop_card_rate')->nullable();
            $table->integer('drop_base_mvp_rate')->nullable();
            $table->integer('drop_card_mvp_rate')->nullable();
            $table->integer('drop_base_special_rate')->nullable();
            $table->integer('drop_card_special_rate')->nullable();
            $table->timestamps();
            $table->index(['base_exp_rate']);
            $table->primary('server_id');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server');
    }
}
