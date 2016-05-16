<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAppSiteMenus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('app_site_menus', function(Blueprint $table)
		{
			$table->integer('service_provider_id')->unsigned();
			$table->foreign('service_provider_id')->references('id')->on('service_providers');
			$table->boolean('is_active')->default(0);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('app_site_menus', function(Blueprint $table)
		{
			$table->dropForeign('app_site_menus_service_provider_id_foreign');
			$table->dropColumn('service_provider_id');
			$table->dropColumn('is_active');


		});
	}

}
