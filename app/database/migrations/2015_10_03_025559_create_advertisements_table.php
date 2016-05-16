<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->integer('service_provider_id')->unsigned();
			$table->foreign('service_provider_id')->references('id')->on('service_providers');
			$table->string('title');
			$table->text('description');
			$table->text('banner_img');
			$table->string('external_uri');
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
		Schema::drop('advertisements');
	}

}
