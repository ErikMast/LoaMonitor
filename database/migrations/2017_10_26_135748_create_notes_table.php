<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('notes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('note_types_id')->unsigned();
			$table->foreign('note_types_id')->references('id')->on('note_types');
            $table->date('date');
            $table->string('notes', 255);
            $table->integer('students_id')->unsigned();
			$table->foreign('students_id')->references('id')->on('students');
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
            Schema::dropIfExists('notes');
    }
}