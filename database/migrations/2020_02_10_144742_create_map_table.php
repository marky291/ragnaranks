<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emulator_maps', static function (Blueprint $table) {
            $table->string('mapname')->primary();
            $table->string('name');
            $table->string('mp3');
            $table->integer('mapType');
            $table->timestamps();
        });

        Schema::create('emulator_map_spawns', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('monster_id');
            $table->string('mapname');
            $table->integer('amount');
            $table->integer('respawnTime');
            $table->timestamps();
        });

        Schema::create('emulator_map_npcs', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('mapname');
            $table->integer('job');
            $table->integer('x');
            $table->integer('y');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('emulator_map_types', function(Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('mapname');
            $table->integer('amount');
            $table->integer('region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emulator_maps');
        Schema::dropIfExists('emulator_map_spawns');
        Schema::dropIfExists('emulator_map_npcs');
    }
}
