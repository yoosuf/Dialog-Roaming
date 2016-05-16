<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertSeedDataToTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		DB::table('roles')->insert(
			[
				'name' => 'admin',
				'is_active' => '1',
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





	}


	public function down()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('roles')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

	}


}
