<?php

use Illuminate\Database\Seeder;
use LoaMonitor\Module;

class TestCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('villages')->insert(
			[
				[
					'name' => 'Emmen',
                ],
				[
					'name' => 'Assen',
                ]

			]
		);

		$usualTime = new DateTime('2000-01-01 12:30:00');
    $endDate = new DateTime("2010-01-01 0:00:00");

		DB::table('students')->insert(
			[
				[
          'id'=>"1",
					'firstname'=>'Jaap',
					'lastname'=>'Aap',
					'student_number'=> '1234',
					'villages_id' => 1,
					'eta'=>$usualTime,
					'groups_id'=>4,
          'previous_groups_id'=>0,
          'is_visible'=>1
				],
				[
          'id'=>"2",
					'firstname'=>'Joep',
					'lastname'=>'Meloen',
					'student_number'=> '4321',
					'villages_id' => 2,
					'eta'=>$usualTime,
					'groups_id'=>1,
          'previous_groups_id'=>0,
          'is_visible'=>1
				],
				[
          'id'=>"3",
          'firstname'=>'Jaap',
					'lastname'=>'Aap_Onzichtbaar',
					'student_number'=> '12345',
					'villages_id' => 1,
					'eta'=>$usualTime,
					'groups_id'=>4,
          'previous_groups_id'=>0,
          'is_visible'=>0
				],
				[
          'id'=>"4",
          'firstname'=>'Joep',
					'lastname'=>'Meloen_Onzichtbaar',
					'student_number'=> '54321',
					'villages_id' => 2,
					'eta'=>$usualTime,
					'groups_id'=>1,
          'previous_groups_id'=>0,
          'is_visible'=>0
				]
      ]
    );
    DB::table('students')->insert(
			[
			  [
					'id'=>"5",
          'firstname'=>'Jaap',
					'lastname'=>'Aap_Einddatum',
					'student_number'=> '123456',
					'villages_id' => 1,
					'eta'=>$usualTime,
					'groups_id'=>4,
          'previous_groups_id'=>0,
          'end_date'=>$endDate,
          'is_visible'=>1
				],
				[
					'id'=>"6",
          'firstname'=>'Joep',
					'lastname'=>'Meloen_Einddatum',
					'student_number'=> '654321',
					'villages_id' => 2,
					'eta'=>$usualTime,
					'groups_id'=>1,
          'previous_groups_id'=>0,
          'end_date'=>$endDate,
          'is_visible'=>1
				]
			]
		);

		$oldDate = new DateTime();
		$oldDate->sub(new DateInterval('P10D'));
    $toBeCalledDate = new DateTime();
    $toBeCalledDate ->sub(new DateInterval("P22D"));

		DB::table('notes')->insert(
			[
				[
					'date'=> $oldDate,
					'notes'=>'status 1',
					'note_types_id'=>2,
					'students_id' => 1,
					'users_id' => 1
				],
				[
					'date'=> new DateTime(),
					'notes'=>'status 2',
					'note_types_id'=>2,
					'students_id' => 1,
					'users_id' => 1
				],
				[
					'date'=> $toBeCalledDate->sub(new DateInterval('P10D')),
					'notes'=>'status 3',
					'note_types_id'=>2,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> $toBeCalledDate,
					'notes'=>'status 4',
					'note_types_id'=>2,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> $oldDate,
					'notes'=>'contact 1',
					'note_types_id'=> 1,
					'students_id' => 1,
					'users_id' => 1
				],
				[
					'date'=> new DateTime(),
					'notes'=>'contact 2',
					'note_types_id'=> 1,
					'students_id' => 1,
					'users_id' => 1
				],
				[
					'date'=> $toBeCalledDate->sub(new DateInterval('P10D')),
					'notes'=>'contact 3',
					'note_types_id'=> 1,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> $toBeCalledDate,
					'notes'=>'contact 4',
					'note_types_id'=> 1,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> $oldDate,
					'notes'=>'note 1',
					'note_types_id'=> 3,
					'students_id' => 1,
					'users_id' => 1
				],
				[
					'date'=> new DateTime(),
					'notes'=>'note 2',
					'note_types_id'=> 3,
					'students_id' => 1,
					'users_id' => 1
				],
				[
					'date'=> $toBeCalledDate->sub(new DateInterval('P10D')),
					'notes'=>'note 3',
					'note_types_id'=> 3,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> $toBeCalledDate,
					'notes'=>'note 4',
					'note_types_id'=> 3,
					'students_id' => 2,
					'users_id' => 1
				]
			]
		);

    $moduleA1 = Module::where('domain', '=', 'A')->where('level', '=', '1')->first();
    $moduleB1 = Module::where('domain', '=', 'B')->where('level', '=', '1')->first();
    DB::table('module_dones')->insert(
            [
                [
                  'modules_id' => $moduleA1->id,
                  'students_id' => 1,
                  'users_id'=> 1,
                  'date' => $oldDate,
                  'result'=> '5'
                ],
                [
                  'modules_id' => $moduleA1->id,
                  'students_id' => 1,
                  'users_id'=> 1,
                  'date' => new DateTime(),
                  'result'=> '6'
                ],
                [
                  'modules_id' => $moduleB1->id,
                  'students_id' => 1,
                  'users_id'=>1,
                  'date' => new DateTime(),
                  'result'=> '7'
                ]
    ]);

    //Unit testing Module
    DB::table('modules')->insert(
      [
        [
          'id'=>"100",
          'domain'=> 'T',
          'level'=>'1',
          'description' => 'Test 1',
          'sbu'=> '10',
        ],
        [
          'id'=>"101",
          'domain'=> 'T',
          'level'=>'2',
          'description' => 'Test 2',
          'sbu'=> '20',
        ]
        ,
        [
          'id'=>"102",
          'domain'=> 'T',
          'level'=>'3',
          'description' => 'Test 3',
          'sbu'=> '30',
        ]
    ]);

    //ModuleDone Unit Tests
    // student id = 3
    $lastweek = new DateTime();
		$lastweek->sub(new DateInterval('P7D'));

    DB::table('module_dones')->insert(
      [
          [
            'id' => 100,
            'modules_id' =>100,
            'students_id' => 3,
            'users_id'=> 1,
            'date' => new DateTime(),
            'date_start' => null,
            'date_end' => null,
            'result'=> '6'
          ],
          [
            'id' => 101,
            'modules_id' => 101,
            'students_id' => 3,
            'users_id'=> 1,
            'date'=> null,
            'date_start' => $lastweek,
            'date_end' => null,
            'result'=>null
          ],
          [
            'id' => 102,
            'modules_id' => 102,
            'students_id' => 3,
            'users_id'=>1,
            'date'=> null,
            'date_start' => $lastweek,
            'date_end' => new DateTime(),
            'result'=>null
          ]
        ]);
   }
}
