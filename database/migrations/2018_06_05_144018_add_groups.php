<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::table('groups')->insert(
        [
          [
            'name' => 'av-vanopleiding', 'sortorder' => '11', 'is_visible' => false
          ],
          [
            'name' => 'sw-vanopleiding', 'sortorder' => '12', 'is_visible' => false
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
        DB::table('groups')->where('name', 'LIKE', '%vanopleiding')->delete();
    }
}
