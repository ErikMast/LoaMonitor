<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLogbooks extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('logbooks', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('original_id')->unsigned();
      $table->integer('students_id')->unsigned();
      $table->foreign('students_id')->references('id')->on('students');
      $table->date('date');
      $table->text('progress')->nullable();
      $table->text('specification')->nullable();
      $table->text('remark')->nullable();
      $table->integer('users_id')->unsigned();
      $table->foreign('users_id')->references('id')->on('users');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
          Schema::dropIfExists('logbooks');
  }
}
