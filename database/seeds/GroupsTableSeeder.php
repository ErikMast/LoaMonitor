<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert(
                [
                    [
						'name' => 'avicos1a'
                    ],
					[
						'name' => 'avicos2a'
                    ],
					[
						'name' => 'avicos3a'
                    ],
					[
						'name' => 'swicos1a'
                    ],
					[
						'name' => 'swicos1b'
                    ],
					[
						'name' => 'swicos2a'
                    ],
					[
						'name' => 'swicos2b'
                    ],
					[
						'name' => 'swicos3a'
                    ]
        ]);
    }
}
