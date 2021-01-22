<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('progresses',  function (Blueprint $table) {
          $table->boolean('deadline_met')->default(1);
      });
      DB::table('progresses')->update(['deadline_met' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('progresses',  function (Blueprint $table) {
          $table->dropColumn('deadline_met');
      });
    }
}
