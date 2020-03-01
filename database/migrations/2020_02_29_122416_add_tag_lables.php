<?php

use App\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagLables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->string('label')->after('name')->nullable();
        });

        (new Tag(['name' => 'ready2pvp', 'label' => 'Ready To PVP']))->save();
        (new Tag(['name' => 'ready2woe', 'label' => 'Ready To WOE']))->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('label');
        });

        Tag::whereName('ready2pvp')->delete();
        Tag::whereName('ready2woe')->delete();
    }
}
