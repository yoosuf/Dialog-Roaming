<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeyFromServiceProviderApisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('service_provider_apis', function(Blueprint $table)
		{
			$table->dropForeign('service_provider_apis_service_provider_id_foreign');
			$table->dropForeign('service_provider_apis_mobile_api_id_foreign');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('service_provider_apis', function(Blueprint $table)
		{
			//
		});
	}

}
