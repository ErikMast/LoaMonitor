<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateModuleGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('module_groups', function (Blueprint $table) {
          $table->increments('id');
          $table->string('domains', 10);
          $table->string('description', 255);
          $table->timestamps();
         }
      );
      DB::table('module_groups')->insert(
          ['domains' => 'A', 'description' => 'Programmeren']
        );
      DB::table('module_groups')->insert(
           ['domains' => 'B', 'description' => 'Database']
         );
      DB::table('module_groups')->insert(
             ['domains' => 'C', 'description' => 'Front-End']
           );
      DB::table('module_groups')->insert(
              ['domains' => 'D', 'description' => 'Documentatie']
            );

      DB::table('module_groups')->insert(
                ['domains' => 'E', 'description' => 'Versiebeheer']
              );
      DB::table('module_groups')->insert(
                 ['domains' => 'F', 'description' => 'Samenwerking']
               );

      DB::table('module_groups')->insert(
                   ['domains' => 'G', 'description' => 'Scrum']
                 );
      DB::table('module_groups')->insert(
                    ['domains' => 'D-G', 'description' => 'Documentatie-Versiebeheer-Scrum']
                  );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_groups');
    }
}
