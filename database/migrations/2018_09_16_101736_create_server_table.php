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
            $table->string('tag')->unique();
            $table->string('name');
            $table->string('description');
            $table->timestamps();

            $table->index(['tag', 'name']);
            $table->unique(['tag', 'name']);
        });

        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('banner_url');
            $table->longText('description');
            $table->string('website');
            $table->unsignedInteger('mode_id');
            $table->double('episode')->nullable();
            $table->integer('votes_count')->default(0);
            $table->integer('clicks_count')->default(0);
            $table->timestamps();

            $table->index(['episode', 'created_at', 'votes_count', 'clicks_count']);

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('mode_id')->references('id')->on('servers_modes')->onUpdate('cascade');
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

        DB::table('servers_modes')->insert([[
                'tag' => 're',
                'name' => 'renewal',
                'description' => 'This server is based on renewal format',
                'updated_at' => now(),
                'created_at' => now(),
            ],[
                'tag' => 'pre-re',
                'name' => 'pre-renewal',
                'description' => 'This server is based on pre-renewal format',
                'updated_at' => now(),
                'created_at' => now(),
            ], [
                'tag' => 'custom',
                'name' => 'custom',
                'description' => 'This server uses a custom format.',
                'updated_at' => now(),
                'created_at' => now(),
            ], [
                'tag' => 'classic',
                'name' => 'classic',
                'description' => 'This server uses a classic format.',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        ]);
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
