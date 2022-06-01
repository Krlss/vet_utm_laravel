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
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 13)->unique();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('name');
            $table->string('last_name1');
            $table->string('last_name2');
            $table->string('email')->unique();
            $table->integer('id_parish')->unsigned()->nullable();
            $table->integer('id_canton')->unsigned()->nullable();
            $table->integer('id_province')->unsigned();
            $table->string('address')->nullable();
            $table->string('phone', 12)->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_parish')->references('id')->on('parishes')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_canton')->references('id')->on('cantons')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_province')->references('id')->on('provinces')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
