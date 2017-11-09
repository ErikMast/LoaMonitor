<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(UsersTableSeeder::class);
		$this->call(GroupsTableSeeder::class);
		$this->call(DaysTableSeeder::class);
		$this->call(TimeTableSeeder::class);
		$this->call(NoteTypesSeeder::class);
		$this->call(ModuleSeeder::class);
     }
}
