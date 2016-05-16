<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeSubmenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('home_submenus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('service_provider_id')->unsigned();
			$table->foreign('service_provider_id')->references('id')->on('service_providers');
			$table->integer('home_menu_id')->unsigned();
			$table->foreign('home_menu_id')->references('id')->on('home_menus');
			$table->string('title');
			$table->text('description');
			$table->string('banner_img');
			$table->string('external_url');
			$table->string('option');
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
		Schema::drop('home_submenus');
	}

}
