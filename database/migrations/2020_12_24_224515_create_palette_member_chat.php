<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaletteMemberChat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palette_member_chat', function (Blueprint $table) {
            $table->id();
            $table->integer('talkroomid');
            $table->integer('partnerid');
            $table->integer('userid');
            $table->integer('posterid');
            $table->string("chat");
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
        Schema::dropIfExists('palette_member_chat');
    }
}
