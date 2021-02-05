<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaletteEventMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palette_event_member', function (Blueprint $table) {
            $table->id();
            $table->integer('eventid');
            $table->integer('groupid');
            $table->integer('userid');
            // 0 = 未承認　1 = 参加
            $table->integer('entry_status')->default(0);
            
            // 0 = 一般　1 = 代表
            $table->integer('representative_status')->default(0);
            
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
        Schema::dropIfExists('palette_event_member');
    }
}
