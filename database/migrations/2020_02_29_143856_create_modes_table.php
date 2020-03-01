<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->timestamp('created_at');
        });

        (new \App\Mode(['name' => 'pre-renewal']))->save();
        (new \App\Mode(['name' => 'renewal']))->save();
        (new \App\Mode(['name' => 'custom']))->save();

        // remove previous tag name.
        \App\Tag::whereName('all')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('modes');
    }
}
