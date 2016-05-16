<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_providers', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('sp_code')->unique();
			$table->string('sp_name');
			$table->string('mcc');
			$table->string('mnc');

			$table->string('country_code');
			$table->string('splash_screen_logo');
			$table->string('splash_screen_text');

			$table->string('main_screen_logo');
			$table->string('main_screen_text');

			$table->string('contact_telephone');
			$table->string('contact_email');

			$table->string('website_url');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('countries');

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
		Schema::drop('service_providers');
	}

}
