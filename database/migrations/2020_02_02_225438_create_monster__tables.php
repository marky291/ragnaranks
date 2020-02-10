<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonsterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emulator_monsters', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('dbname');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('emulator_monster_stats', function (Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('attackRange');
            $table->integer('level');
            $table->integer('health');
            $table->integer('sp');
            $table->integer('str');
            $table->integer('int');
            $table->integer('vit');
            $table->integer('dex');
            $table->integer('agi');
            $table->integer('luk');
            $table->integer('rechargeTime');
            $table->integer('atk1');
            $table->integer('atk2');
            $table->json('attack');
            $table->json('magicAttack');
            $table->integer('defense');
            $table->integer('baseExperience');
            $table->integer('jobExperience');
            $table->integer('aggroRange');
            $table->integer('escapeRange');
            $table->integer('movementSpeed');
            $table->integer('attackSpeed');
            $table->integer('attackedSpeed');
            $table->integer('element');
            $table->integer('scale');
            $table->integer('race');
            $table->integer('magicDefense');
            $table->integer('hit');
            $table->integer('flee');
            $table->string('ai');
            $table->integer('mvp');
            $table->integer('class');
            $table->integer('attr');
            $table->timestamps();
        });

        Schema::create('emulator_monster_spawn_set', function (Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('id');
            $table->string('type');
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::create('emulator_monster_slaves', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('id');
            $table->integer('idx');
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::create('emulator_monster_metamorphosis', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('id');
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::create('emulator_monster_sounds', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->string('filename');
            $table->timestamps();
        });

        Schema::create('emulator_monster_quest_objective', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('quest_id');
            $table->timestamps();
        });

        Schema::create('emulator_monster_drops', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id')->primary();
            $table->unsignedBigInteger('item_id');
            $table->integer('chance');
            $table->boolean('stealProtected');
            $table->string('serverTypeName');
            $table->timestamps();
        });

        Schema::create('emulator_monster_mvp_drops', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('chance');
            $table->boolean('stealProtected');
            $table->string('serverTypeName')->nullable();
            $table->timestamps();
        });

        Schema::create('emulator_monster_skills', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('idx');
            $table->integer('skillId');
            $table->string('status');
            $table->integer('level');
            $table->integer('chance');
            $table->integer('casttime');
            $table->integer('delay');
            $table->boolean('interruptable');
            $table->string('changeTo')->nullable();
            $table->string('condition')->nullable();
            $table->string('conditionValue')->nullable();
            $table->string('sendType')->nullable();
            $table->string('sendValue')->nullable();
            $table->timestamps();
        });

        Schema::create('emulator_monster_properties', function(Blueprint $table) {
            $table->unsignedBigInteger('monster_id');
            $table->integer('0');
            $table->integer('1');
            $table->integer('2');
            $table->integer('3');
            $table->integer('4');
            $table->integer('5');
            $table->integer('6');
            $table->integer('7');
            $table->integer('8');
            $table->integer('9');
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
    }
}
