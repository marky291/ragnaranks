<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmulatorItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emulator_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aegisName')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('slots');
            $table->integer('setname')->nullable();
            $table->integer('itemTypeId');
            $table->string('itemType');
            $table->integer('itemSubTypeId');
            $table->string('subType');
            $table->integer('attack');
            $table->integer('defence')->default(0);
            $table->double('weight');
            $table->integer('requiredLevel')->nullable();
            $table->integer('limitLevel');
            $table->integer('weaponLevel');
            $table->integer('job')->nullable();
            $table->integer('compositionPos')->nullable();
            $table->string('composition');
            $table->integer('attribute')->nullable();
            $table->string('location')->nullable();
            $table->integer('price')->nullable();
            $table->integer('range')->nullable();
            $table->integer('matk')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('refinable')->nullable();
            $table->integer('indestructible')->nullable();
            $table->string('cardPrefix')->nullable();
            $table->text('script')->nullable();
            $table->timestamps();
        });

        Schema::create('emulator_item_soldby', function(Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('npc_id');
            $table->integer('price');
            $table->timestamps();
        });

        Schema::create('emulator_item_move_info', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->boolean('drop');
            $table->boolean('trade');
            $table->boolean('store');
            $table->boolean('cart');
            $table->boolean('sell');
            $table->boolean('mail');
            $table->boolean('auction');
            $table->boolean('guildstore');
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('emulator_items');
        });

        Schema::create('emulator_item_contains', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('internalType')->default('');
            $table->integer('type');
            $table->unsignedBigInteger('sourceId');
            $table->string('sourceName');
            $table->unsignedBigInteger('targetId');
            $table->string('targetName');
            $table->integer('count');
            $table->integer('totalOfSource');
            $table->string('summonType');
            $table->integer('chance');
            $table->index(['sourceId', 'targetId']);
//            $table->foreign('sourceId')->references('id')->on('emulator_items');
//            $table->foreign('targetId')->references('id')->on('emulator_items');
            $table->timestamps();
        });

        Schema::create('emulator_item_combos', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('set_id');
            $table->timestamps();
        });

        Schema::create('emulator_combos', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('emulator_crawler_errors', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_id');
            $table->text('message');
            $table->text('link');
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
        Schema::dropIfExists('emulator_items');
        Schema::dropIfExists('emulator_npcs');
        Schema::dropIfExists('emulator_item_soldby');
    }
}
