<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('groups',  function (Blueprint $table) {
        $table->integer('next_groups_id')->unsigned();
      });

      DB::table('groups')->insert(
        [
          [
            'id' => '99', 'name' => 'Niets', 'sortorder' => '14', 'is_visible' => false, "next_groups_id" => '99'
          ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('groups', function (Blueprint $table) {
        $table->dropColumn('next_groups_id');
      });
    }
}
