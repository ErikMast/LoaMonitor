<?php

use Illuminate\Database\Seeder;

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
		
		DB::table('students')->insert(
			[	
				[
					'firstname'=>'Jaap',
					'lastname'=>'Aap',
					'student_number'=> '1234',
					'villages_id' => 1,
					'eta'=>$usualTime,
					'groups_id'=>4
				],
				[
					'firstname'=>'Joep',
					'lastname'=>'Meloen',
					'student_number'=> '4321',
					'villages_id' => 2,
					'eta'=>$usualTime,
					'groups_id'=>1
				]
			]
		);
		
		$oldDate = new DateTime();
		$oldDate->sub(new DateInterval('P10D'));
		
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
					'date'=> $oldDate,
					'notes'=>'status 3',
					'note_types_id'=>2,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> new DateTime(),
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
					'date'=> $oldDate,
					'notes'=>'contact 3',
					'note_types_id'=> 1,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> new DateTime(),
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
					'date'=> $oldDate,
					'notes'=>'note 3',
					'note_types_id'=> 3,
					'students_id' => 2,
					'users_id' => 1
				],
				[
					'date'=> new DateTime(),
					'notes'=>'note 4',
					'note_types_id'=> 3,
					'students_id' => 2,
					'users_id' => 1
				]
			]
		);
   }
}
