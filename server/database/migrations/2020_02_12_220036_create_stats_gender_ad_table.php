<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsGenderAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_gender_ad', function (Blueprint $table) {
            $table->unsignedBigInteger('stats_gender_id');
            $table->unsignedBigInteger('ad_id');
            $table->unsignedBigInteger('advertiser_id')->default(0);
            $table->integer('visitors_number')->default(0);
        });
        Schema::table('stats_gender_ad', function (Blueprint $table) {
            $table->foreign('stats_gender_id')->references('id')->on('stats_genders')->onDelete('cascade');
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_gender_ad');
    }
}
