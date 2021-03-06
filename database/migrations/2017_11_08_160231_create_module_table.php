<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
 		    Schema::create('modules', function (Blueprint $table) {
 			      $table->increments('id');
            $table->string('domain', 1)->default("");
            $table->integer('level')->unsigned();
            $table->string('description', 255);
            $table->timestamps();
 		       }
         );
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('modules');
     }
}
