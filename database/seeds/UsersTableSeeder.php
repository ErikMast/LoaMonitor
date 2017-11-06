<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert(
      [
        [
				      'email' => 'e.mast@drenthecollege.nl',
                        'password' => bcrypt('Test'),
                        'firstname' => 'Erik',
                        'lastname' => 'Mast'
        ],
        [
              'email' => 'a.balfaqih@drenthecollege.nl',
                        'password' => bcrypt('Test'),
                        'firstname' => 'Aminah',
                        'lastname' => 'Balfaqih'
        ],
        [
              'email' => 'h.steenbergen@drenthecollege.nl',
                        'password' => bcrypt('Test'),
                        'firstname' => 'Harmen',
                        'lastname' => 'Steenbergen'
        ]
      ]);
    }
}
