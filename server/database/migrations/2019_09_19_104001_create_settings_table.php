<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('settings', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->longText('about_us');
			$table->longText('mission');
			$table->longText('vision');
			$table->string('about_us_image');
			$table->string('mission_image');
			$table->string('vision_image');
			$table->longText('terms');
			$table->longText('privacy');
			$table->string('intro_video')->nullable();
			$table->string('email');
			$table->string('address');
			$table->string('mobile');
			$table->string('lat')->nullable();
			$table->string('lng')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('twitter')->nullable();
			$table->unsignedInteger('campaign_min_Duration')->default(0);
			$table->unsignedInteger('campaign_min_budget')->default(0);
			$table->unsignedInteger('ad_min_budget')->default(0);
			$table->unsignedInteger('ad_click_price')->default(1);
			$table->unsignedInteger('taxes')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('settings');
	}
}
