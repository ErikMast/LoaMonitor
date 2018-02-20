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
						'name' => 'avicos1a', 'sortorder' => '1'
                    ],
					[
						'name' => 'avicos2a', 'sortorder' => '2'
                    ],
					[
						'name' => 'avicos3a', 'sortorder' => '3'
                    ],
					[
						'name' => 'swicos1a', 'sortorder' => '4'
                    ],
					[
						'name' => 'swicos1b', 'sortorder' => '5'
                    ],
					[
						'name' => 'swicos2a', 'sortorder' => '6'
                    ],
					[
						'name' => 'swicos2b', 'sortorder' => '7'
                    ],
					[
						'name' => 'swicos3a', 'sortorder' => '8'
                    ]
        ]);
    }
}
