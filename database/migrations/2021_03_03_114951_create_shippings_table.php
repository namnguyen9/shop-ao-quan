<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->unsignedInteger('user_id');
            $table->string('street_names');
            $table->string('wards_and_communes');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('province_and_city_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('province_and_city_id')->references('id')->on('provinces_and_cities');
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
        Schema::dropIfExists('shippings');
    }
}
