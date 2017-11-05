<?php

use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert(
                [
                    [
						'name' => 'maandag'
                    ],
					[
						'name' => 'dinsdag'
                    ],
					[
						'name' => 'woensdag'
                    ],
					[
						'name' => 'donderdag'
                    ],
					[
						'name' => 'vrijdag'
                    ]
        ]);
                
    }
}
