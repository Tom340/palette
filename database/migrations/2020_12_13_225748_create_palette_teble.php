<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaletteTeble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palette_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('activity_content');
            $table->string('other_content');
            $table->integer('established');
            $table->string('objective');
            $table->string('pref');
            $table->string('city');
            $table->string('activity_term_st');
            $table->string('activity_term_ed');
            $table->integer('member_num')->nullable();
            $table->integer('age_st');
            $table->integer('age_ed');
            $table->string('level_st');
            $table->string('level_ed');
            $table->string('message');
            $table->string('memo')->nullable();
            $table->string('homepage')->nullable();
            $table->integer('created_userid');
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
        Schema::dropIfExists('palette_groups');
    }
}
