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
                    ]
        ]);
    }
}
