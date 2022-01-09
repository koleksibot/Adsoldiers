<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldierAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soldier_analytics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_utm')->unique()->nullable();
            $table->longText('age')->nullable();
            $table->longText('gender')->nullable();
            $table->longText('targeted_audience')->nullable();
            $table->timestamps();
        });

        Schema::table('soldier_analytics', function (Blueprint $table) {
            $table->foreign('user_utm')->references('utm')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soldier_analytics');
    }
}
