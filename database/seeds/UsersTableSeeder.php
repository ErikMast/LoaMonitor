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
                        'password' => bcrypt('Welkom1234'),
                        'firstname' => 'Erik',
                        'lastname' => 'Mast'
        ],
        [
              'email' => 'a.balfaqih@drenthecollege.nl',
                        'password' => bcrypt('Welkom1234'),
                        'firstname' => 'Aminah',
                        'lastname' => 'Balfaqih'
        ],
        [
              'email' => 'h.steenbergen@drenthecollege.nl',
                        'password' => bcrypt('Welkom1234'),
                        'firstname' => 'Harmen',
                        'lastname' => 'Steenbergen'
        ],
        [
              'email' => 'b.bergmann@drenthecollege.nl',
                        'password' => bcrypt('Welkom1234'),
                        'firstname' => 'Benn',
                        'lastname' => 'Bergman'
        ]
      ]);
    }
}
