<?php

use Illuminate\Database\Seeder;

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
                    'domain' => 'A',
                    'level' => 1,
                    'description'=>'Programmeren Basis',
                    'sbu'=>52
                  ],
                  [
                    'domain' => 'A',
                    'level' => 1,
                    'description'=>'Introductie programmeren in JAVA',
                    'sbu'=>60
                  ],
                  [
                    'domain' => 'B',
                    'level' => 1,
                    'description'=>'Introductie Database',
                    'sbu'=>26
                  ],
                  [
                    'domain' => 'B',
                    'level' => 2,
                    'description'=>'Connectie met de Database',
                    'sbu'=>52
                  ],
                  [
                    'domain' => 'C',
                    'level' => 1,
                    'description'=>'HTML en CSS',
                    'sbu'=>52
                  ],
                  [
                    'domain' => 'C',
                    'level' => 2,
                    'description'=>'Javascript/RegEx/JQuery',
                    'sbu'=>104
                  ],
                  [
                    'domain' => 'C',
                    'level' => 3,
                    'description'=>'Bootstrap',
                    'sbu'=>78
                  ],
                  [
                    'domain' => 'E',
                    'level' => 1,
                    'description'=>'Eigen code onder controle',
                    'sbu'=>26
                  ]

      ]);
    }
}
