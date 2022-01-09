<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsAgeSoldierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_age_soldier', function (Blueprint $table) {
            $table->unsignedBigInteger('stats_age_id');
            $table->unsignedBigInteger('soldier_id');
            $table->integer('visitors_number')->default(0);
        });
        Schema::table('stats_age_soldier', function (Blueprint $table) {
            $table->foreign('stats_age_id')->references('id')->on('stats_ages')->onDelete('cascade');
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
        Schema::dropIfExists('stats_age_soldier');
    }
}
