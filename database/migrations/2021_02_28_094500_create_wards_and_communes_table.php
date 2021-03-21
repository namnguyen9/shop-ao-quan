<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsAndCommunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards_and_communes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
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
        Schema::dropIfExists('wards_and_communes');
    }
}
