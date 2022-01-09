<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('currencies', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('currency_name');
			$table->string('currency_name_en');
			$table->string('iso4217_alpha3');
			$table->string('iso4217_num3');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('currencies');
	}
}
