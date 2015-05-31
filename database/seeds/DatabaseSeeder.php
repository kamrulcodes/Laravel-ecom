<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsersTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {

	public function run() {
		$user = new User;
		$user->firstname = 'Jon';
		$user->lastname = 'Doe';
		$user->email = 'jon@doe.com';
		$user->password = Hash::make('mypassword');
		$user->telephone = '5557771234';
		$user->admin = 1;
		$user->save();
	}
}
