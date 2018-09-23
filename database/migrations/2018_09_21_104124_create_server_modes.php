<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\ServerMode;

class CreateServerModes extends Migration
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
        });


        DB::table('servers_modes')->insert([
            [
                'tag' => 're',
                'name' => 'renewal',
                'description' => 'This server is based on renewal format',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'tag' => 'pre-re',
                'name' => 'pre-renewal',
                'description' => 'This server is based on pre-renewal format',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'tag' => 'custom',
                'name' => 'custom',
                'description' => 'This server uses a custom format.',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'tag' => 'classic',
                'name' => 'classic',
                'description' => 'This server uses a classic format.',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        ]);

        Schema::table('servers', function(Blueprint $table) {

            $table->foreign('mode_id')->references('id')->on('servers_modes')
                ->onDelete('cascade')->onUpdate('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers_modes');
    }
}
