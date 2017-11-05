<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		
		Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->integer('student_number');
			$table->integer('villages_id')->unsigned();
			$table->foreign('villages_id')->references('id')->on('villages');
			$table->integer('groups_id')->unsigned();
			$table->foreign('groups_id')->references('id')->on('groups');
			$table->time('eta')->default('12:30:00');
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
         Schema::dropIfExists('students');
    }
}
