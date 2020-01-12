<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemdbSoldby extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_db', static function(Blueprint $table) {
            $table->unsignedInteger('id')->unique();
            $table->string('aegis_name');
            $table->string('name');
            $table->string('description');
            $table->unsignedSmallInteger('class_num');
            $table->unsignedSmallInteger('slots');
            $table->string('setname')->nullable();
            $table->unsignedSmallInteger('itemTypeId');
            $table->unsignedSmallInteger('itemSubTypeId');
            $table->unsignedSmallInteger('attack')->default(0);
            $table->unsignedSmallInteger('defense')->default(0);
            $table->unsignedSmallInteger('weight')->default(0);
            $table->unsignedSmallInteger('requiredLevel')->nullable();
            $table->unsignedSmallInteger('limitLevel')->default(0);
            $table->unsignedSmallInteger('weaponLevel')->default(0);
            $table->unsignedSmallInteger('job')->nullable();
            $table->unsignedSmallInteger('compositionPos')->nullable();
            $table->unsignedSmallInteger('attribute')->nullable();
            $table->unsignedSmallInteger('location');
            $table->unsignedSmallInteger('accessory')->nullable();
            $table->unsignedSmallInteger('price');
            $table->unsignedSmallInteger('range')->nullable();
            $table->unsignedSmallInteger('matk')->nullable();
            $table->unsignedSmallInteger('gender')->nullable();
            $table->unsignedSmallInteger('refinable')->nullable();
            $table->unsignedSmallInteger('indestructible')->nullable();
            $table->unsignedSmallInteger('cardPrefix')->nullable();
        });

        Schema::create('item_db_soldby', static function (Blueprint $table) {
            $table->smallInteger('item_db_id');
            $table->smallInteger('npc_db_id');
            $table->integer('price');
            $table->primary(['item_db_id', 'npc_db_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_db_soldby');
    }
}
