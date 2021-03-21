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
            $table->increments('id');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password',60)->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable()->default("chưa rõ");
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
