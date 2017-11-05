<?php

use Illuminate\Database\Seeder;

class NoteTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('note_types')->insert(
                [
                    [
						'name' => 'Contact',
						'description'=>'Als je contact hebt tijdens LOA'
                    ],
					[
						'name' => 'Progressie',
						'description'=>'Als je wilt vastleggen waar iemand mee bezig is'
                    ],
					[
						'name' => 'Notitie',
						'description'=>'Als je wilt vastleggen dat iemand bijv. naar rijexamen is'
                    ]
        ]);
    }
}
