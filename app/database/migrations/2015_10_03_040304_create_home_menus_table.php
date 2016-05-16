<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('home_menus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('service_provider_id')->unsigned();
			$table->foreign('service_provider_id')->references('id')->on('service_providers');
			$table->string('title');
			$table->text('banner_img');
			$table->boolean('is_active')->default(0);
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
		Schema::drop('home_menus');
	}

}
