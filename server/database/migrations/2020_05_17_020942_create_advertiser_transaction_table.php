<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertiserTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertiser_id');
            $table->unsignedBigInteger('ad_id');
            $table->integer('amount');
            $table->enum('status', ['pending', 'done', 'canceled'])->default('pending');
            $table->timestamps();
        });

        Schema::table('advertiser_transaction', function (Blueprint $table) {
            $table->foreign('advertiser_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_transaction');
    }
}
