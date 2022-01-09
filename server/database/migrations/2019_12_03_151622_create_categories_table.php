<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('categories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('cover_img');
			$table->timestamps();
		});

		Schema::create('library_category', function (Blueprint $table) {
			$table->unsignedBigInteger('library_id');
			$table->unsignedBigInteger('category_id');
			$table->primary(['library_id', 'category_id']);
		});

		Schema::table('library_category', function (Blueprint $table) {
			$table->foreign('library_id')->references('id')->on('libraries')->onDelete('cascade');
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('categories');
		// pivot table
		Schema::dropIfExists('library_category');
	}
}
