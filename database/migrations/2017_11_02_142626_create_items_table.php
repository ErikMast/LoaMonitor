<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csvdatas', function (Blueprint $table) {
          $table->increments('id');
          $table->string('stamnr');
          $table->date('geboortedatum');
          $table->string('roepnaam');
          $table->string('tussenv')->nullable();
          $table->string('achternaam');
          $table->string('woonplaats');
		  $table->string('klas');
          $table->timestamp('created_at');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csvdatas');
    }
}
