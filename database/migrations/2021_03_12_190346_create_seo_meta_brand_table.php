<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoMetaBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_meta_brand', function (Blueprint $table) {
            $table->increments('id');
            $table->text('meta_keywords')->nullable()->default('chưa có');
            $table->text('meta_desc')->nullable()->default('chưa có');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
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
        Schema::dropIfExists('seo_meta_brand');
    }
}
