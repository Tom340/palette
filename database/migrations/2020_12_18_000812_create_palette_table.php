<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaletteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palette_group_members', function (Blueprint $table) {
            $table->id();
            $table->integer('groupid');
            $table->integer('userid');
            // 0 = 未承認　1 = 参加中
            $table->integer('entry_status')->default(0);
            // 0 = 一般メンバー　1 = 代表
            $table->integer('representative_status')->default(0);
            // 0 = 閲覧可　＊要協議
            $table->integer('reading_status')->default(0);
            
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
        Schema::dropIfExists('palette_group_members');
    }
}
