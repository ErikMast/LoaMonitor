<?php

use Illuminate\Database\Seeder;
use LoaMonitor\ModuleGroup;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('modules')->insert(
              [
                  [
                    'level' => 1,
                    'description'=>'Programmeren Basis',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'A')->first()['id'],
                    'sbu'=>52
                  ],
                  [
                    'level' => 1,
                    'description'=>'Introductie programmeren in JAVA',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'A')->first()['id'],
                    'sbu'=>60
                  ],
                  [
                    'level' => 1,
                    'description'=>'Introductie Database',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'B')->first()['id'],
                    'sbu'=>26
                  ],
                  [
                    'level' => 2,
                    'description'=>'Connectie met de Database',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'B')->first()['id'],
                    'sbu'=>52
                  ],
                  [
                    'level' => 1,
                    'description'=>'HTML en CSS',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'C')->first()['id'],
                    'sbu'=>52
                  ],
                  [
                    'level' => 2,
                    'description'=>'Javascript/RegEx/JQuery',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'C')->first()['id'],
                    'sbu'=>104
                  ],
                  [
                    'level' => 3,
                    'description'=>'Bootstrap',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'C')->first()['id'],
                    'sbu'=>78
                  ],
                  [
                    'level' => 1,
                    'description'=>'Eigen code onder controle',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'E')->first()['id'],
                    'sbu'=>26
                  ],
                  [
                    'level' => 2,
                    'description'=>'Code indelen in PHP',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'A')->first()['id'],
                    'sbu'=>32
                  ],
                  [
                    'level' => 2,
                    'description'=>'Code indelen in Java',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'A')->first()['id'],
                    'sbu'=>32
                  ],
                  [
                    'level' => 3,
                    'description'=>'Object Oriented Programming in Java',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'A')->first()['id'],
                    'sbu'=>64
                  ],
                  [
                    'level' => 3,
                    'description'=>'Werken met relationele databases',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'B')->first()['id'],
                    'sbu'=>0
                  ],
                  [
                    'level' => 4,
                    'description'=>'Normaliseren',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'B')->first()['id'],
                    'sbu'=>0
                  ],
                  [
                    'level' => 4,
                    'description'=>'Angular.js',
                    'module_groups_id'=> ModuleGroup::where('domains', '=','C')->first()['id'],
                    'sbu'=>26
                  ],
                  [
                    'level' => 2,
                    'description'=>'Samen in code werken',
                    'module_groups_id'=> ModuleGroup::where('domains', '=', 'E')->first()['id'],
                    'sbu'=>26
                  ],
                  [
                    'level' => 1,
                    'description'=>'Projecten doen',
                    'module_groups_id' => ModuleGroup::where('domains', '=', 'DG')->first()['id'],
                    'sbu' => 32
                  ],
                  [
                    'level' => 2,
                    'description'=>'Samen projecten doen',
                    'module_groups_id' => ModuleGroup::where('domains', '=', 'DG')->first()['id'],
                    'sbu' => 32
                  ]
      ]);
    }
}
