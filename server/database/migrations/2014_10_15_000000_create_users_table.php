<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->unsignedBigInteger('company_id')->index()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('picture');
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->text('permissions')->nullable();
            $table->string('utm')->unique()->nullable();
            $table->unsignedInteger('tasks_lvl')->default(1);
            $table->unsignedInteger('limit')->default(0);
            $table->unsignedInteger('monthly_visits')->default(0);
            $table->unsignedInteger('balance')->default(0);
            $table->timestamps();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
