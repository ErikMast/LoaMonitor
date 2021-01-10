<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('progress', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('students_id')->unsigned();
        $table->foreign('students_id')->references('id')->on('students');
        $table->date('date');
        $table->date('date_deadline')->nullable();
        $table->text('notes');
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
      Schema::dropIfExists('progress');
    }
}
