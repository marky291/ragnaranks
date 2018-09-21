<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers_configs', function(Blueprint $table)
        {
            $table->unsignedInteger('server_id');

            $table->integer('max_base_level')->nullable();
            $table->integer('max_job_level')->nullable();
            $table->integer('max_stats')->nullable();
            $table->integer('max_aspd')->nullable();

            $table->integer('instant_cast_stat')->nullable();

            $table->integer('drop_base_rate')->nullable();
            $table->integer('drop_card_rate')->nullable();
            $table->integer('drop_base_mvp_rate')->nullable();
            $table->integer('drop_card_mvp_rate')->nullable();
            $table->integer('drop_base_special_rate')->nullable();
            $table->integer('drop_card_special_rate')->nullable();

            $table->timestamps();

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
        //
    }
}
