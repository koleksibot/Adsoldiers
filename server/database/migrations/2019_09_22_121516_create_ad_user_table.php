<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_user', function (Blueprint $table) {
            $table->unsignedBigInteger('soldier_id');
            $table->unsignedBigInteger('ad_id');
            $table->primary(['soldier_id', 'ad_id']);
            $table->unsignedInteger('profit');
            $table->dateTime('reached_limit_at', 0)->nullable();
            $table->timestamps();
        });

        Schema::table('ad_user', function (Blueprint $table) {
            $table->foreign('soldier_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ad_user');
    }
}
