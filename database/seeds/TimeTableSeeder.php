<?php

use Illuminate\Database\Seeder;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $date = new DateTime('2000-01-01 12:30:00');
		DB::table('timetables')->insert(
		[
				[
                        'date_start'=>$date,
						'days_id' => 1,
                        'groups_id' => 1,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 2,
                        'groups_id' => 1,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 1,
                        'groups_id' => 3,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 2,
                        'groups_id' => 3,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 5,
                        'groups_id' => 3,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 2,
                        'groups_id' => 4,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 5,
                        'groups_id' => 4,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 2,
                        'groups_id' => 5,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 5,
                        'groups_id' => 5,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 1,
                        'groups_id' => 8,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 2,
                        'groups_id' => 8,

                ],
				[
                        'date_start'=>$date,
						'days_id' => 5,
                        'groups_id' => 8,

                ],
        ]);

   }
}
