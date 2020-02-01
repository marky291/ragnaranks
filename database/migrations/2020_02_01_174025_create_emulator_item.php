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
            $table->string('aegisName');
            $table->string('name');
            $table->string('description');
            $table->integer('slots');
            $table->integer('setname')->nullable();
            $table->integer('itemTypeId');
            $table->integer('itemSubTypeId');
            $table->integer('attack');
            $table->integer('defence')->default(0);
            $table->double('weight');
            $table->integer('requiredLevel')->nullable();
            $table->integer('limitLevel');
            $table->integer('weaponLevel');
            $table->integer('job')->nullable();
            $table->integer('compositionPos')->nullable();
            $table->integer('attribute')->nullable();
            $table->integer('location')->nullable();
            $table->integer('price');
            $table->integer('range')->nullable();
            $table->integer('matk')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('refinable')->nullable();
            $table->integer('indestructible')->nullable();
            $table->string('cardPrefix')->nullable();
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
    }
}
