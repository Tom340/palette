<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palette_user', function (Blueprint $table) {
            $table->id();
            $table->string('name_sei');
            $table->string('name_mei');
            $table->string('kana_sei');
            $table->string('kana_mei');
            $table->string('cellular');
            $table->string('email')->unique();
            $table->text('profile_image');
            $table->smallInteger('sex');
            $table->date('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('palette_user');
    }
}
