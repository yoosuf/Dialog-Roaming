<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectedSiteMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('selected_site_menus', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('service_provider_id')->unsigned();
			$table->foreign('service_provider_id')->references('id')->on('service_providers');

			$table->integer('app_site_menu_id')->unsigned();
			$table->foreign('app_site_menu_id')->references('id')->on('app_site_menus');
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
		Schema::drop('selected_site_menus');
	}

}
