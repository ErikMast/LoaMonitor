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
                    'description'=>'Programmeren Basis'
                  ],
                  [
                    'domain' => 'B',
                    'level' => 1,
                    'description'=>'Introductie Database'
                  ],
                  [
                    'domain' => 'B',
                    'level' => 2,
                    'description'=>'Connectie met de Database'
                  ],
                  [
                    'domain' => 'C',
                    'level' => 1,
                    'description'=>'HTML en CSS'
                  ],
                  [
                    'domain' => 'C',
                    'level' => 2,
                    'description'=>'Javascript/RegEx/JQuery'
                  ],
                  [
                    'domain' => 'C',
                    'level' => 3,
                    'description'=>'Bootstrap'
                  ]

      ]);
    }
}
