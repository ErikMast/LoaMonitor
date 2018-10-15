<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterModuledones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('module_dones',  function (Blueprint $table) {
          $table->date('date_start')->nullable()->default(null);
          $table->date('date_end')->nullable()->default(null);
          $table->date('date')->nullable()->change();
          $table->string('result', 25)->nullable()->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('module_dones', function (Blueprint $table) {
        $table->dropColumn('date_start');
        $table->dropColumn('date_end');
      });
    }
}
