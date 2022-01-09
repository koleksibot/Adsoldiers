<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('content', 255);
            $table->string('country');
            $table->string('city');
            $table->string('language');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('budget')->default(0);
            $table->unsignedInteger('remaining_budget')->default(0);
            $table->string('media');
            $table->string('age');
            $table->unsignedInteger('monthly_clicks')->default(0);
            $table->unsignedInteger('clicks')->default(0);
            $table->string('gender');
            $table->string('targeted_audience');
            $table->string('call_of_action_txt')->nullable();
            $table->string('call_of_action_url')->nullable();
            $table->string('media_type');
            // $table->integer('daily_budget')->default(0);
            // $table->date('approved_at')->nullable();
            // $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('campaign_id');
            $table->unsignedBigInteger('advertiser_id');
            $table->enum('status', ['unpaid', 'reviewing', 'active', 'finished'])->default('unpaid');
            $table->timestamps();
        });
        Schema::table('ads', function (Blueprint $table) {
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
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
        Schema::dropIfExists('ads');
    }
}
