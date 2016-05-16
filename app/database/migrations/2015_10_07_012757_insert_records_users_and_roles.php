<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertRecordsUsersAndRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('users')->truncate();
		DB::table('roles')->truncate();




		DB::table('roles')->insert([
				[
					'name' => 'Administrator',
					'is_active' => '1',
				],
				[
					'name' => 'Service Provider',
					'is_active' => '1',
				],
				[
						'name' => 'Service Partner',
						'is_active' => '1',
				]
			]
		);



		DB::table('users')->insert(
				[
						'username' => 'admin',
						'password' => Hash::make('password'),
						'is_active' => '1',
						'initial_login' => '1',
						'role_id' => 1,
				]
		);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
