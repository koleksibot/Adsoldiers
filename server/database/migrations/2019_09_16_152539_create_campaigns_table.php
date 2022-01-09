<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('campaigns', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('company_id')->index();
			$table->unsignedBigInteger('owner_id')->index();
			$table->string('title')->unique();
			$table->string('type');
			// $table->string('industry');
			// $table->string('location');
			// $table->string('description');
			// $table->longText('content');
			// $table->date('start_date');
			// $table->date('end_date');
			// $table->integer('daily_budget')->default(0);
			// $table->integer('budget')->default(0);
			// $table->integer('remaining_budget')->default(0);
			// $table->date('approved_at')->nullable();
			// $table->unsignedBigInteger('currency_id');
			$table->timestamps();
		});
		// Schema::table('campaigns', function (Blueprint $table) {
		// 	$table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('campaigns');
	}
}
