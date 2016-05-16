<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserMsisdns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('app_user_msisdns', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('app_user_id')->unsigned();
			$table->foreign('app_user_id')->references('id')->on('app_users');
			$table->string('auth_code');
			$table->string('msisdn');
			$table->boolean('is_active');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('app_user_msisdns');
	}

}
