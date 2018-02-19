<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('groups',  function (Blueprint $table) {
          $table->integer('sortorder')->unsigned();
      });

      $results = DB::table('groups')->orderBy("name")->get();
      $sortorder = 0;
      foreach($results as $result) {
        $sortorder++;
        DB::table('groups')->where('id', '=', $result->id)->update(["sortorder"=>$sortorder]);
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('groups', function (Blueprint $table) {
        $table->dropColumn('sortorder');
      });
    }
}
