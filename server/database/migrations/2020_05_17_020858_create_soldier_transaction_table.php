<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldierTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soldier_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transNumber');
            $table->unsignedBigInteger('soldier_id');
            $table->integer('amount');
            $table->integer('balance')->default(0);
            $table->enum('status', ['pending', 'done', 'canceled'])->default('pending');
            $table->timestamps();
        });

        Schema::table('soldier_transaction', function (Blueprint $table) {
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
        Schema::dropIfExists('soldier_transaction');
    }
}
