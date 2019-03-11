<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;
use LoaMonitor\Module;
use LoaMonitor\ModuleGroup;

class AlterModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('modules',  function (Blueprint $table) {
        $table->integer('module_groups_id')->unsigned();
        //$table->foreign('module_groups_id')->references('id')->on('module_groups');
      });

      //field conversion
      $modules = Module::all();
      foreach($modules as $module) {
        $moduleGroup = ModuleGroup::where('domains', '=', $module->domain)->first()['id'];
        Log::info($moduleGroup);
        $module->module_groups_id = $moduleGroup;
        $module->save();
        Log::info($module);
      }

      Schema::table('modules',  function (Blueprint $table) {
        $table->foreign('module_groups_id')->references('id')->on('module_groups');
      });

      if (Schema::hasColumn('modules', 'domain')) {
          Schema::table('modules', function(Blueprint $table) {
            $table->dropColumn('domain');
          });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


      Schema::table('modules', function (Blueprint $table) {
        $table->dropForeign('modules_module_groups_id_foreign');
        $table->dropColumn('module_groups_id');
      });
    }
}
