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
                    [ 'id'=>'1',
						'name' => 'avicos1a', 'sortorder' => '1', "next_groups_id" => '0'
                    ],
					[ 'id'=>'2',
						'name' => 'avicos2a', 'sortorder' => '2', "next_groups_id" => '0'
                    ],
					[  'id'=>'3',
						'name' => 'avicos3a', 'sortorder' => '3', "next_groups_id" => '0'
                    ],
					[  'id'=>'4',
						'name' => 'swicos1a', 'sortorder' => '4', "next_groups_id" => '0'
                    ],
					[  'id'=>'5',
						'name' => 'swicos1b', 'sortorder' => '5', "next_groups_id" => '0'
                    ],
					[  'id'=>'6',
						'name' => 'swicos2a', 'sortorder' => '6', "next_groups_id" => '0'
                    ],
					[  'id'=>'7',
						'name' => 'swicos2b', 'sortorder' => '7', "next_groups_id" => '0'
                    ],
					[  'id'=>'8', 
						'name' => 'swicos3a', 'sortorder' => '8', "next_groups_id" => '0'
                    ]
        ]);
    }
}
