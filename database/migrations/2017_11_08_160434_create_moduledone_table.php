<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuledoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
 		    Schema::create('module_dones', function (Blueprint $table) {
 			      $table->increments('id');
 			      $table->integer('modules_id')->unsigned();
       			$table->foreign('modules_id')->references('id')->on('modules');
            $table->date('date');
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
             Schema::dropIfExists('module_dones');
     }
}
