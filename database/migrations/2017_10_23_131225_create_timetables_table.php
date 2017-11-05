<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
			$table->increments('id');
			
			$table->date('date_start');
			$table->date('date_end')->default('9999-12-31 23:59:59');
			
			$table->integer('days_id')->unsigned();
			$table->foreign('days_id')->references('id')->on('days');
			
			$table->integer('groups_id')->unsigned();
			$table->foreign('groups_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
