<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsCountrySoldierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_country_soldier', function (Blueprint $table) {
            $table->unsignedBigInteger('stats_country_id');
            $table->unsignedBigInteger('soldier_id');
            $table->integer('visitors_number')->default(0);
        });
        Schema::table('stats_country_soldier', function (Blueprint $table) {
            $table->foreign('stats_country_id')->references('id')->on('stats_countries')->onDelete('cascade');
            $table->foreign('soldier_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_country_soldier');
    }
}
