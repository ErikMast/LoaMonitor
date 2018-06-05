<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentsAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('students',  function (Blueprint $table) {
        $table->date('end_date')->nullable();
        $table->boolean('is_visible')->default(0);
      });
      DB::table('students')->update(['end_date' => null, 'is_visible' => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('students', function (Blueprint $table) {
        $table->dropColumn('end_date');
        $table->dropColumn('is_visible');
      });
    }
}
