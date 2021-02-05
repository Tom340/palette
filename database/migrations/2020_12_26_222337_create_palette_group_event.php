<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaletteGroupEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palette_group_event', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('overview');
            $table->string('genre');
            $table->string('sub_genre')->nullable();
            $table->string('event_form');
            $table->string('paid');
            $table->date('eventdate_st');
            $table->string('eventtime_st');
            $table->date('eventdate_ed')->nullable();
            $table->string('eventtime_ed')->nullable();
            $table->integer('capacity');
            $table->date('recruitdate_st');
            $table->string('recruittime_st');
            $table->date('recruitdate_ed')->nullable();
            $table->string('recruittime_ed')->nullable();
            $table->text('event_img')->nullable();
            $table->string('event_info');
            $table->string('place_name');
            $table->string('place_url')->nullable();
            $table->string('country');
            $table->string('pref');
            $table->string('city');
            $table->string('building')->nullable();
            $table->integer('groupid');
            $table->integer('created_userid');
            // 0 = 公開　1=非公開
            $table->integer('public_status')->default(0);
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
        Schema::dropIfExists('palette_group_event');
    }
}
